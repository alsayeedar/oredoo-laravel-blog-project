<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->route("dashboard.home");
        }
        $enable_registration = SiteSetting::first("enable_registration")->enable_registration;
        return view("auth.signup", compact("enable_registration"));
    }

    public function signup(Request $request) {
        if (Auth::check()) {
            return redirect()->route("frontend.home");
        }
        $enable_registration = SiteSetting::first("enable_registration")->enable_registration;
        if (!$enable_registration) {
            return back();
        }
        $validated = $request->validate([
            "name" => ["required", "string", "min:3", "max:100"],
            "username" => ["required", "string", "regex:/\w*$/", "unique:users,username", "max:100"],
            "email" => ["required", "email:rfc", "unique:users,email", "max:255"],
            "password" => ["required", "confirmed", "min:6", "max:100"],
            "password_confirmation" => ["required"],
            "agree" => ["required", "accepted"],
        ]);
        $user = User::create($request->only(["name", "username", "email", "password"]));
        Auth::loginUsingId($user->id);
        return redirect()->route("dashboard.home");
    }
}
