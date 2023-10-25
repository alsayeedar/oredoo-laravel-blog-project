<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view("dashboard.setting.profile", compact("user"));
    }

    public function update(Request $request) {
        $user = User::find(Auth::id());
        $validated = $request->validate([
            "name" => ["required", "string", "min:2", "max:200"],
            "username" => ["required", "string", "min:3", "max:150", Rule::unique("users", "username")->ignore($user->id), "regex:/\w*$/"],
            "email" => ["required", "email:rfc", "max:255", Rule::unique("users", "email")->ignore($user->id)],
            "about" => ["nullable", "string"],
            "profile" => ["nullable", "image"],
            "facebook" => ["nullable", "url", "max:255"],
            "twitter" => ["nullable", "url", "max:255"],
            "instagram" => ["nullable", "url", "max:255"],
            "linkedin" => ["nullable", "url", "max:255"],
            "youtube" => ["nullable", "url", "max:255"],
        ]);
        $user->name = $validated["name"];
        $user->username = $validated["username"];
        $user->email = $validated["email"];
        $user->about = Arr::has($validated, "about") ? $validated["about"] : $user->about;
        $user->facebook = Arr::has($validated, "facebook") ? $validated["facebook"] : $user->facebook;
        $user->twitter = Arr::has($validated, "twitter") ? $validated["twitter"] : $user->twitter;
        $user->instagram = Arr::has($validated, "instagram") ? $validated["instagram"] : $user->instagram;
        $user->linkedin = Arr::has($validated, "linkedin") ? $validated["linkedin"] : $user->linkedin;
        $user->youtube = Arr::has($validated, "youtube") ? $validated["youtube"] : $user->youtube;
        if (Arr::has($validated, "profile")) {
            $image = $request->file("profile");
            $imageName = md5(time().rand(11111, 99999)).".".$image->extension();
            $image->move(public_path("uploads/author"), $imageName);
            if ($user->profile) {
                if (File::exists(public_path("uploads/author/".$user->profile))) {
                    File::delete(public_path("uploads/author/".$user->profile));
                }
            }
            $user->profile = $imageName;
        }
        $user->save();
        return back()->with("success", "Profile updated!");
    }

    public function password() {
        return view("dashboard.setting.password");
    }

    public function passwordUpdate(Request $request) {
        $user = User::find(Auth::id());
        $validated = $request->validate([
            "current_password" => ["required", "current_password"],
            "new_password" => ["required", "min:6", "string", "confirmed"],
            "new_password_confirmation" => ["required"],
        ]);
        $user->password = $validated["new_password"];
        $user->save();
        return back()->with("success", "Password changed!");
    }
}
