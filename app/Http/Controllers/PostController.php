<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Post::query();

        // Filter by user names
        if ($request->has('user_name')) {
            $query->whereHas('user', function ($userQuery) use ($request) {
                $userQuery->where('name', 'like', '%' . $request->input('user_name') . '%');
            });
        }

        // Filter by dates
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $categories = Category::all();
        foreach($categories as $category){
            $tags = $category->tags;
        }

        // Big Slider Posts.
        $topSliderPosts = $query->where('status', 'active')->latest()->take(6)->get();

        // Mini Top Slider Posts.
        $mainSliderPosts = $query->where('status', 'active')->latest()->skip(6)->get();

        // Category Mini Slider Posts.
        $categoryTechnologyPosts = Post::where('category_id', 1)->get()->take(4);
        $categorySportsPosts = Post::where('category_id', 2)->get()->take(4);
        $categoryBusinessPosts = Post::where('category_id', 4)->get()->take(4);
        $categoryEntertainmentPosts = Post::where('category_id', 5)->get()->take(4);

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
        $trendingPosts = Post::where('status', 'active')->where('views', '>=',
        10)->orderBy('views', 'desc')->take(5)->get();

        return view('home.index', compact('topSliderPosts', 'mainSliderPosts', 'categories', 'categoryBusinessPosts', 'categoryTechnologyPosts', 'categorySportsPosts', 'categoryEntertainmentPosts', 'latestPostsSection1', 'latestPostsSection1LastTwo', 'latestPostsSection2', 'latestPostsSection2LastTwo', 'tags', 'category', 'popularPostsSection1', 'popularPostsSection1LastTwo', 'popularPostsSection2', 'popularPostsSection2LastTwo', 'trendingPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if ($user) {
            $categories = Category::all();
            $tags = [];
            return view('dashboard.posts.create', compact('categories', 'tags'));
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
            Post::create([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'image' => $path,
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('post.index')->with('success', 'Post created successfully.');
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
        $tags = $post->category->tags;
        return view('dashboard.posts.show', compact('post', 'comments', 'tags', 'category'));
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
            if ($user->id == $post->user_id) {
                $categories = Category::all();
                $tags = $post->category->tags;
                return view('dashboard.posts.edit', compact('post', 'categories','tags'));
            }
            return abort(404);
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
        $request->validate([
            'title' => 'sometimes|required|min:3|max:255|unique:posts,title',
            'description' => 'sometimes|required|min:3',
            'image' => 'sometimes|required|image|mimes:jpeg,png,gif,jpg,webp',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            $old_image = $post->image;
            Storage::disk('public')->delete($old_image);
            $file = $request->file('image');
            $path = $file->store('uploads/posts', 'public');
        }
        $post->update([
            'title' => $request->post('title'),
            'description' => $request->post('description'),
            'image' => $path,
            'category_id' => $request->post('category_id'),
        ]);
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

    // public function inactivatedPosts()
    // {
    //     $user = auth()->user();
    //     if ($user) {
    //         $posts = Post::where('user_id', $user->id)->where('status',
    //         '!=', 'active')->get();
    //         // $posts = Post::where('status', 'inactivate')->get();
    //         return view('posts.inactive-posts', ['posts' => $posts])->with('success', 'Post Published Successfully.');
    //     }
    //     return redirect()->route('login');
    // }

    public function allLatestPosts()
    {
        $posts = Post::where('status', 'active')->latest()->paginate(12);
        $latestBigPosts = $posts->slice(0, 2);
        $latestSmallPosts = $posts->slice(2, 10);

        $categories = Category::all();
        foreach($categories as $category){
            $tags = $category->tags;
        }

        return view('dashboard.posts.all-latest-posts', compact('posts', 'tags', 'category', 'latestBigPosts', 'latestSmallPosts'));
    }

    public function popularPosts()
    {
        $posts = Post::where('status', 'active')->where('views', '>=', 1)->orderBy('views', 'desc')->paginate(12);
        $latestBigPosts = $posts->slice(0, 2);
        $latestSmallPosts = $posts->slice(2, 10);

        $categories = Category::all();
        foreach($categories as $category){
            $tags = $category->tags;
        }

        return view('dashboard.posts.popular-posts', compact('posts', 'tags', 'category', 'latestBigPosts', 'latestSmallPosts'));
    }
}
