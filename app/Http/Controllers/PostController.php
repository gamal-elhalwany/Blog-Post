<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PostStatusNotification;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-post', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-post', ['only' => ['edit', 'update']]);
        $this->middleware('permission:show-post', ['only' => ['show']]);
        $this->middleware('permission:delete-post', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post)
    {
        $now = Carbon::now();
        $query = Post::query();

        // Big Slider Posts.
        $topSliderPosts = $query->where('status', 'active')->latest()->take(6)->get();

        // Mini Top Slider Posts.
        $mainSliderPosts = $query->where('status', 'active')->latest()->skip(6)->get();

        // Category Mini Slider Posts.
        $categoryTechnologyPosts = Post::where('category_id', 1)->where('status', 'active')->get()->take(4);
        $categorySportsPosts = Post::where('category_id', 2)->where('status', 'active')->get()->take(4);
        $categoryBusinessPosts = Post::where('category_id', 4)->where('status', 'active')->get()->take(4);
        $categoryEntertainmentPosts = Post::where('category_id', 5)->where('status', 'active')->get()->take(4);

        // Latest Posts Queries.
        $latestPostsSection1 = Post::where('status', 'active')->latest()->take(1)->get();
        $latestPostsSection1LastTwo = Post::where('status', 'active')->latest()->skip(1)->take(2)->get();
        $latestPostsSection2 = Post::where('status', 'active')->latest()->skip(3)->take(1)->get();
        $latestPostsSection2LastTwo = Post::where('status', 'active')->latest()->skip(4)->take(2)->get();

        // Popular Posts Queries.
        $popularPostsSection1 = Post::where('status', 'active')->orderBy('views', 'desc')->take(1)->get();
        $popularPostsSection1LastTwo = Post::where('status', 'active')->orderBy('views', 'desc')->skip(1)->take(2)->get();
        $popularPostsSection2 = Post::where('status', 'active')->orderBy('views', 'desc')->skip(3)->take(1)->get();
        $popularPostsSection2LastTwo = Post::where('status', 'active')->orderBy('views', 'desc')->skip(4)->take(2)->get();

        // Trending Posts.
        $trendingPosts = Post::where('status', 'active')->where(
            'views',
            '>=',
            10
        )->orderBy('views', 'desc')->take(5)->get();

        // Featured Posts.
        $featuredPosts = Post::where('status', 'active')->where('featured', true)->get();

        return view('home.index', compact('topSliderPosts', 'mainSliderPosts', 'categoryBusinessPosts', 'categoryTechnologyPosts', 'categorySportsPosts', 'categoryEntertainmentPosts', 'latestPostsSection1', 'latestPostsSection1LastTwo', 'latestPostsSection2', 'latestPostsSection2LastTwo', 'popularPostsSection1', 'popularPostsSection1LastTwo', 'popularPostsSection2', 'popularPostsSection2LastTwo', 'trendingPosts', 'featuredPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin', 'Editor')) {
            return view('dashboard.posts.create');
        }
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $request->validate([
                'title' => 'required|min:3|max:255|unique:posts,title',
                'description' => 'required|min:3',
                'image' => 'required|image|mimes:jpeg,png,gif,jpg,webp',
                'category_id' => ['required', 'exists:categories,id'],
            ]);

            $file = $request->file('image');
            $path = $file->store('uploads/posts', 'public');

            $tag_ids = [];
            if ($request->post('tags')) {
                $tags = json_decode($request->post('tags'));
                $allTags = Tag::all();
                foreach ($tags as $tag_name) {
                    $slug = Str::slug($tag_name->value);
                    $tag = $allTags->where('slug', $slug)->first();
                    if (!$tag) {
                        $tag = Tag::create([
                            'name' => $tag_name->value,
                            'slug' => $slug,
                        ]);
                    }
                    $tag_ids[] = $tag->id;
                }

                $post = Post::create([
                    'title' => $request->get('title'),
                    'description' => $request->get('description'),
                    'image' => $path,
                    'user_id' => auth()->user()->id,
                    'category_id' => $request->category_id,
                ]);

                // the sync function is used only with belongToMany relationships and here I assigned the tags array to the tags model after creating it to check if there is a category_id then will delete it or if not will create it.
                $post->tags()->sync($tag_ids);
            }

            return redirect()->route('post.index')->with('success', 'Post created successfully and Waiting to be approved!.');
        }
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post, Category $category)
    {
        // Get the viewed_posts cookie
        $viewedPosts = json_decode($request->cookie('viewed_posts', '[]'), true);

        // Check if the post has been viewed by this user
        if (!in_array($post->id, $viewedPosts)) {
            // Increment the views count
            $post->increment('views');

            // Add the post ID to the viewed posts
            $viewedPosts[] = $post->id;

            // Save the updated viewed posts back to the cookie
            Cookie::queue('viewed_posts', json_encode($viewedPosts), 60 * 24 * 30); // Store for 30 days
        }

        $comments = $post->comments->where('parent_id', null);
        return view('dashboard.posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user = auth()->user();
        if ($user) {
            if ($user->id == $post->user_id || $user->hasAnyRole('Owner', 'Super-admin', 'Admin', 'Editor')) {
                return view('dashboard.posts.edit', compact('post'));
            }
            return abort(403);
        }
        return redirect()->route('login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|min:3|max:255|unique:posts,title',
            'description' => 'sometimes|required|min:3',
            'image' => 'sometimes|required|image|mimes:jpeg,png,gif,jpg,webp',
            'category_id' => 'required|exists:categories,id',
            'tags.*.value' => 'exists:tags,id',
        ]);

        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            $old_image = $post->image;
            Storage::disk('public')->delete($old_image);
            $file = $request->file('image');
            $path = $file->store('uploads/posts', 'public');
        } else {
            $path = $post->image;
        }
        $post->update([
            'title' => $request->post('title'),
            'description' => $request->post('description'),
            'image' => $path,
            'category_id' => $request->post('category_id'),
        ]);

        $tag_ids = [];
        if ($request->post('tags')) {

            if ($post->tags) {
                foreach ($post->tags as $tag) {
                    $tag->delete();
                }
            }

            $tags = json_decode($request->post('tags'));
            $allTags = Tag::all();
            foreach ($tags as $tag_name) {
                $slug = Str::slug($tag_name->value);
                $tag = $allTags->where('slug', $slug)->first();
                if (!$tag) {
                    $tag = Tag::create([
                        'name' => $tag_name->value,
                        'slug' => $slug,
                    ]);
                }
                $tag_ids[] = $tag->id;
            }
        }
        $post->tags()->sync($tag_ids);
        return redirect()->route('post.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =  Post::findOrFail($id);
        if (auth()->id() == $post->user_id) {
            $post->delete();
            return redirect()->route('home')->with('success', 'Post Deleted Successfully.');
        }
        return redirect()->back()->with('error', 'You are not allow to this action!');
    }

    public function allLatestPosts()
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin', 'Editor')) {
            $posts = Post::where('status', 'active')->latest()->paginate(12);
            $latestBigPosts = $posts->slice(0, 2);
            $latestSmallPosts = $posts->slice(2, 10);
            return view('dashboard.posts.all-latest-posts', compact('posts', 'latestBigPosts', 'latestSmallPosts'));
        }
        return abort(403);
    }

    public function popularPosts()
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin', 'Editor')) {
            $posts = Post::where('status', 'active')->where('views', '>=', 1)->orderBy('views', 'desc')->paginate(12);
            $latestBigPosts = $posts->slice(0, 2);
            $latestSmallPosts = $posts->slice(2, 10);

            return view('dashboard.posts.popular-posts', compact('posts', 'latestBigPosts', 'latestSmallPosts'));
        }
        return abort(403);
    }

    public function featuredPosts()
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin', 'Editor')) {
            $posts = Post::where('status', 'active')->where('featured', true)->get();
            return view('dashboard.posts.featured-posts', compact('posts'));
        }
        return abort(403);
    }

    public function pendingPosts()
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin', 'Editor')) {
            $posts = Post::where('status', '!=', 'active')->get();
            return view('dashboard.posts.manage-posts', compact('posts'));
        }
    }

    public function approve(Post $post)
    {
        $post->status = 'active';
        $post->save();

        // Send notification to the post owner
        $post->user->notify(new PostStatusNotification($post, 'approved'));
        return redirect()->back()->with('success', 'Post approved successfully.');
    }

    public function reject(Post $post)
    {
        $post->status = 'rejected';
        $post->save();

        // Send notification to the post owner
        $post->user->notify(new PostStatusNotification($post, 'Rejected'));
        return redirect()->back()->with('success', 'Post rejected successfully.');
    }

    public function search_posts(Request $request, Post $post)
    {
        $request->validate([
            'search' => 'required',
        ]);
        $search = $request->input('search');
        $query = Post::query();

        // Filter by usernames or Post titles.
        if ($request->input('search')) {
            $search = $request->input('search');
            $results = Post::where('status', 'active')
                ->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    })->orWhere('title', 'LIKE', "%{$search}%");
                })->get();
        }
        return view('home.search-result', compact('results'));

        // Filter by dates to user it later.
        // if ($request->has('start_date') && $request->has('end_date')) {
        //     $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
        //     $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
        //     $query->whereBetween('created_at', [$startDate, $endDate]);
        // }
    }
}
