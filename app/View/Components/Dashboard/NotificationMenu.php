<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NotificationMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $notifications; 
    public$newcount;

    public function __construct( $count=10)
    {
        $user=Auth::user();
        $this->notifications =$user->notifications()->take($count)->get();
        $this->newcount = $user->unreadNotifications()->count();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notification-menu');
    }
}
