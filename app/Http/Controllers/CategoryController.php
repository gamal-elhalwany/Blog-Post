<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user) {
            $categories = Category::all();
            return view('dashboard.category.create', compact('categories'));
        }
        return redirect()->route('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
        ]);

        $user = auth()->user();
        if ($user) {
            Category::create($request->all());
            return redirect()->back()->with('success', 'Category created successfully');
        }
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $user = auth()->user();
        if ($user) {
            $posts = $category->posts()->paginate(14);
            $section1 = $posts->slice(0, 4);
            $section2 = $posts->slice(4, 10);
            return view('dashboard.category.show', compact('category', 'posts', 'section1', 'section2'));
        }
        return redirect()->route('login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $user = auth()->user();
        if ($user) {
            return view('dashboard.category.edit', compact('category'));
        }
        return redirect()->route('login');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $user = auth()->user();
        if ($user) {
            $category->delete();
            return redirect()->back()->with('success', 'The category is deleted.');
        }
        return redirect()->route('login');
    }
}
