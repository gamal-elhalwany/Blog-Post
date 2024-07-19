<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user) {
            return view('dashboard.category.index');
        }
        return redirect()->route('login');
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
        // $user = auth()->user();
        // if ($user) {
        //     return view('dashboard.category.show', compact('category'));
        // }
        // return redirect()->route('login');
        return 'This is the single ' . $category->name . ' Page. Welcome ' . auth()->user()->name;
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
