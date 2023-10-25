<?php

namespace App\View\Components\Frontend;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarCategory extends Component
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
        $categories = Category::where("status", true)->orderBy("title", "ASC")->get();
        return view('components.frontend.sidebar-category', compact("categories"));
    }
}
