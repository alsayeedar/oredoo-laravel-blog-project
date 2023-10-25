<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() {
        $recentposts = Post::with("category")->where("status", true)->orderBy("id", "DESC")->paginate(10);
        $featuredposts = Post::with(["category", "user"])->where("status", true)->where("is_featured", true)->orderBy("id", "DESC")->limit(10)->get();
        $categories = Category::where("status", true)->orderBy("title", "ASC")->limit(10)->get();
        return view("frontend.home.index", compact("recentposts", "featuredposts", "categories"));
    }
}
