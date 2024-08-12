<?php

namespace App\View\Components;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $trendingPosts;
    public $tags;
    public $category;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $categories = Category::all();
        foreach($categories as $category){
            $tags = $category->tags;
        }

        $trendingPosts = Post::where('status', 'active')->where('views', '>=',
        10)->orderBy('views', 'desc')->take(5)->get();
        $this->trendingPosts =  $trendingPosts;
        $this->tags = $tags;
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
