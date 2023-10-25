<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $posts = Post::count();
        $comments = Comment::count();
        $users = User::count();
        $categories = Category::count();
        return view("dashboard.home.index", compact("posts", "comments", "users", "categories"));
    }
}
