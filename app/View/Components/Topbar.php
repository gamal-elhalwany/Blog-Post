<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Topbar extends Component
{
    public $now;
    /**
     * Create a new component instance.
     */
    public function __construct(Carbon $now)
    {
        $now = Carbon::now();
        $now->setTimezone('Africa/Cairo');
        $now->format('Y-m-d H:i:s A');
        $this->now = $now;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.topbar', ['now' => $this->now]);
    }
}
