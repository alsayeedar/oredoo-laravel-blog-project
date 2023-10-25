<?php

namespace App\View\Components\Frontend;

use App\Models\SocialMedia;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarSocial extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $socialmedia = SocialMedia::whereStatus(true)->orderBy("id", "ASC")->get();
        return view('components.frontend.sidebar-social', compact("socialmedia"));
    }
}
