<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $trendingPosts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $trendingPosts = Post::where('status', 'active')->where(
            'views',
            '>=',
            10
        )->orderBy('views', 'desc')->take(5)->get();

        $this->trendingPosts =  $trendingPosts;
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
