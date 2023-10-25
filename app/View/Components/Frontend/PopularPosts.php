<?php

namespace App\View\Components\Frontend;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PopularPosts extends Component
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
        $popularposts = Post::where("status", true)->orderBy("views", "DESC")->limit(5)->get();
        return view('components.frontend.popular-posts', compact("popularposts"));
    }
}
