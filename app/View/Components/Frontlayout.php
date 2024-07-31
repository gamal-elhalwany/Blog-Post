<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Tag;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Frontlayout extends Component
{
    $tags;
    // public $categories;
    /**
     * Create a new component instance.
     */
    public function __construct($)
    {
        // $this->tags = $category->tags->take(25);
        $categories = Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.front.front-layout');
    }
}
