<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create-category', ['only' => ['index', 'create', 'store']]);
        $this->middleware('permission:edit-category', ['only' => ['edit', 'update']]);
        $this->middleware('permission:show-category', ['only' => ['show']]);
        $this->middleware('permission:delete-category', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin')) {
            return view('dashboard.category.index');
        }
        return abort(403,  'You do not have permission to access this page!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin')) {
            return view('dashboard.category.create');
        }
        return abort(403,  'You do not have permission to access this page');
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
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin')) {
            $category = Category::create($request->all());
            return redirect()->back()->with('success', 'Category created successfully');
        }
        return abort(403,  'You do not have permission to access this page');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin')) {
            $posts = $category->posts()->paginate(14);
            $section1 = $posts->slice(0, 4);
            $section2 = $posts->slice(4, 10);
            return view('dashboard.category.show', compact('category', 'posts', 'section1', 'section2'));
        }
        return abort(403,  'You do not have permission to access this page');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin')) {
            return view('dashboard.category.edit', compact('category'));
        }
        return abort(403,  'You do not have permission to access this page');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|min:3',
        ]);

        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin')) {
            $category->update($request->all());
            return redirect()->back()->with('success', 'Category updated successfully ☺');
        }
        return abort(403,  'You do not have permission to access this page');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $user = auth()->user();
        if ($user->hasAnyRole('Owner', 'Super-admin', 'Admin')) {
            $category->delete();
            return redirect()->back()->with('success', 'The category is deleted.');
        }
        return abort(403,  'You do not have permission to access this page');
    }
}
