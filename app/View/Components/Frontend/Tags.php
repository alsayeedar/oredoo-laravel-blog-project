<?php

namespace App\View\Components\Frontend;

use App\Models\Tag;
use Illuminate\Support\Str;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Tags extends Component
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
        $tags = Tag::orderBy("name", "ASC")->limit(12)->get();
        $str = Str::class;
        return view('components.frontend.tags', compact("tags", "str"));
    }
}
