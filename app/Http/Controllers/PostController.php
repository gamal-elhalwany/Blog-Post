<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now = Carbon::now();
        $now->setTimezone('Africa/Cairo');
        $now->format('Y-m-d H:i:s A');

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

        $posts = $query->where('status', 'active')->latest()->get();
        $categories = Category::all();
        return view('home.index', compact('posts', 'now', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
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
            'image' => 'sometimes|required|image|mimes:jpeg,png,gif,jpg',
        ]);

        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }
        $post->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' => $imageName ?? $post->image,
            'status' => $request->status,
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
            return redirect()->back()->with('success', 'Post Deleted Successfully.');
        }
        return redirect()->back()->with('error', 'You are not allow to this action!');
    }

    public function inactivatedPosts()
    {
        $posts = Post::where('status', 'inactivate')->get();
        return view('posts.inactive-posts', ['posts' => $posts])->with('success', 'Post Published Successfully.');
    }
}
