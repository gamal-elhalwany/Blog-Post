<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NotificationsMenu extends Component
{
    public $notifications;
    public $unreadNotifications;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = Auth::user();
        if ($user) {
            $this->notifications = $user->notifications()->get();
            $this->unreadNotifications = $user->unreadnotifications()->count();
        } else {
            $this->notifications = collect();
            $this->unreadNotifications = 0;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications-menu');
    }
}
