<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|exists:users,name',
            'email' => 'required|exists:users,email',
            'comment' => 'required',
        ]);

        if ($user) {
            $comments = Comment::create([
                'comment' => $request->comment,
                'user_id' => $user->id,
                'post_id' => $request->post_id,
                'user_id' => $user->id,
            ]);
            return redirect()->back()->with('success', 'Your Comment added Successfully');
        }
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeReply(Request $request, $id)
    {
        $user = auth()->user();
        $comment = Comment::findOrFail($id);
        $request->validate([
            'comment' => 'required',
        ]);
        if ($user) {
            $comment->create([
                'comment' => $request->comment,
                'user_id' => $user->id,
                'post_id' => $request->post_id,
                'parent_id' => $id,
            ]);
            return redirect()->back()->with('success', 'Your Comment added Successfully');
        }
        return redirect()->route('login');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
