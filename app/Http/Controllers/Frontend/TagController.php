<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index($name) {
        $tag = Tag::whereName(Str::lower(Str::headline($name)))->first();
        if ($tag) {
            $posts = $tag->posts()->paginate(10);
            $tag = Str::lower(Str::headline($name));
            return view("frontend.tag.index", compact("posts", "tag"));
        }
        return redirect()->route("frontend.home");
    }
}
