<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class CommentController extends Controller
{
    public function index(Request $request, $id) {
        $post = Post::where("status", true)->where("enable_comment", true)->find($id);
        if ($post) {
            $rules = [
                "message" => ["required", "string", "min:3"],
            ];
            if (!Auth::check()) {
                $rules["name"] = ["required", "string", "min:3", "max:100"];
                $rules["email"] = ["required", "email:rfc", "max:255"];
            }
            $validated = $request->validate($rules);
            if (!Auth::check() && User::where("email", $validated["email"])->first()) {
                return redirect()->route("frontend.post", $post->slug."#comment-form")->withErrors("An account with this email address already exists. Please login before commenting or use another email address!");
            }
            if (Auth::check()) {
                Comment::create([
                    "message" => $validated["message"],
                    "post_id" => $post->id,
                    "user_id" => Auth::id()
                ]);
                return redirect()->route("frontend.post", $post->slug."#comment-form")->with("success", "Success! Your comment has been posted!");
            } else {
                Comment::create([
                    "message" => $validated["message"],
                    "name" => $validated["name"],
                    "email" => $validated["email"],
                    "post_id" => $post->id,
                    "status" => "0"
                ]);
                return redirect()->route("frontend.post", $post->slug."#comment-form")->with("success", "Success! Your comment is awaiting moderation!");
            }
        }
        return abort(404);
    }

    public function reply(Request $request) {
        $rules = [
            "message" => ["required", "string", "min:3"],
            "id" => ["required", "integer"],
        ];
        if (!Auth::check()) {
            $rules["name"] = ["required", "string", "min:3", "max:100"];
            $rules["email"] = ["required", "email:rfc", "max:255"];
        }
        $validated = $request->validate($rules);
        $comment = Comment::with("post")->where("id", $validated["id"])->where("status", true)->where("parent_id", null)->first();
        if ($comment && $comment->post && $comment->post->status && $comment->post->enable_comment) {
            if (!Auth::check() && User::where("email", $validated["email"])->first()) {
                return redirect()->route("frontend.post", $comment->post->slug."#comment-form")->withErrors("An account with this email address already exists. Please login before replying or use another email address!");
            }
            if (Auth::check()) {
                Comment::create([
                    "message" => $validated["message"],
                    "post_id" => $comment->post->id,
                    "parent_id" => $validated["id"],
                    "user_id" => Auth::id()
                ]);
                return redirect()->route("frontend.post", $comment->post->slug."#comment-form")->with("success", "Success! Your reply has been posted!");
            } else {
                Comment::create([
                    "message" => $validated["message"],
                    "name" => $validated["name"],
                    "email" => $validated["email"],
                    "post_id" => $comment->post->id,
                    "parent_id" => $validated["id"],
                    "status" => "0"
                ]);
                return redirect()->route("frontend.post", $comment->post->slug."#comment-form")->with("success", "Success! Your reply is awaiting moderation!");
            }
        }
        return abort(403);
    }
}
