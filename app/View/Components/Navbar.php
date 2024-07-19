<?php

namespace App\View\Components;

use Closure;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Navbar extends Component
{
    public $categories;
    public $posts;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categories = Category::all();
        $this->posts = Post::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
