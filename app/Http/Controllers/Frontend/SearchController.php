<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {
        if ($request->q) {
            $query = $request->q;
            $posts = Post::with("category")->whereStatus(true)->where("title", "LIKE", "%{$query}%")->orWhere("title", "LIKE", "%{$query}%")->orderBy("id", "DESC")->paginate(10);
            return view("frontend.search.index", compact("posts", "query"));
        }
        return redirect()->route("frontend.home");
    }
}
