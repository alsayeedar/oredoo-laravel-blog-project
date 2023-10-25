<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SocialMediaController extends Controller
{
    public function index() {
        $socialmedia = SocialMedia::paginate(20);
        return view("dashboard.setting.socialmedia", compact("socialmedia"));
    }

    public function add(Request $request) {
        $validated = $request->validate([
            "title" => ["required", "string", "min:1", "max:100"],
            "icon" => ["required", "string", "min:1", "max:100"],
            "link" => ["required", "url", "max:255"],
            "color" => ["required", "regex:/^(#(?:[0-9a-f]{2}){2,4}|#[0-9a-f]{3}|(?:rgba?|hsla?)\((?:\d+%?(?:deg|rad|grad|turn)?(?:,|\s)+){2,3}[\s\/]*[\d\.]+%?\))$/i"],
            "status" => ["required", Rule::in(["0", "1"])],
        ]);
        SocialMedia::create($validated);
        return back()->with("success", "Social media added!");
    }

    public function status($id) {
        $media = SocialMedia::find($id);
        if ($media) {
            $media->status = $media->status ? "0" : "1";
            $media->save();
            $alert = $media->status ? "Media activated!" : "Media inactivated!";
            return back()->with("success", $alert);
        }
        return back()->withErrors("Media not exists!");
    }

    public function delete($id) {
        $media = SocialMedia::find($id);
        if ($media) {
            $media->delete();
            return back()->with("success", "Media deleted!");
        }
        return back()->withErrors("Media not exists!");
    }
}
