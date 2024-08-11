<?php

namespace App\View\Components;

use Closure;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Topbar extends Component
{
    public $now;
    public $trendingPosts;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $trendingPosts = Post::where('status', 'active')->where('views', '>=',
        10)->orderBy('views', 'desc')->take(5)->get();

        $now = Carbon::now();
        $now->setTimezone('Africa/Cairo');
        // $now->format('Y-m-d H:i:s A');
        $now = $now->format('d/m/Y');

        $this->now = $now;
        $this->trendingPosts = $trendingPosts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.topbar');
    }
}
