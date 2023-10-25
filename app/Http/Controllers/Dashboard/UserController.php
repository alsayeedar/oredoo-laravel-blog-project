<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index() {
        $users = User::withCount(["posts" => function($q) {
            $q->withTrashed();
        }])->orderBy("role", "DESC")->paginate(20);
        return view("dashboard.user.index", compact("users"));
    }

    public function create() {
        return view("dashboard.user.add");
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "name" => ["required", "string"],
            "username" => ["required", "unique:users,username", "string", "regex:/\w*$/"],
            "email" => ["required", "email:rfc", "unique:users,email", "max:255"],
            "password" => ["required", "min:6", "max:100"],
            "about" => ["nullable", "string"],
            "role" => ["required", Rule::in(["1", "2", "3"])],
            "status" => ["required", Rule::in(["1", "0"])],
            "profile" => ["nullable", "image"]
        ]);
        if (Arr::has($validated, "profile")) {
            $image = $request->file("profile");
            $imageName = md5(time().rand(11111, 99999)).".".$image->extension();
            $image->move(public_path("uploads/author"), $imageName);
        }
        User::create([
            "name" => $validated["name"],
            "username" => $validated["username"],
            "email" => $validated["email"],
            "password" => $validated["password"],
            "about" => Arr::has($validated, "about") ? $validated["about"] : null,
            "role" => $validated["role"],
            "status" => $validated["status"],
            "profile" => Arr::has($validated, "profile") ? $imageName : null,
        ]);
        return redirect()->route("dashboard.users.index")->with("success", "User created!");
    }

    public function show(string $id)  {
        return abort(404);
    }

    public function edit(string $id) {
        $user = User::find($id);
        if ($user) {
            return view("dashboard.user.edit", compact("user"));
        }
        return back()->withErrors("User not exists!");
    }

    public function update(Request $request, string $id) {
        $user = User::find($id);
        if ($user) {
            $rules = [
                "name" => ["required", "string"],
                "username" => ["required", Rule::unique("users", "username")->ignore($user->id), "min:3", "max:150", "string", "regex:/\w*$/"],
                "email" => ["required", "email:rfc", "max:255", Rule::unique("users", "email")->ignore($user->id)],
                "about" => ["nullable", "string"],
                "profile" => ["nullable", "image"]
            ];
            if ($user != Auth::user()) {
                $rules["role"] = ["required", Rule::in(["1", "2", "3"])];
                $rules["status"] = ["required", Rule::in(["1", "0"])];
            }
            $validated = $request->validate($rules);
            $user->name = $validated["name"];
            $user->username = $validated["username"];
            $user->email = $validated["email"];
            $user->about = Arr::has($validated, "about") ? $validated["about"] : null;
            $user->role = Arr::has($validated, "role") ? $validated["role"] : $user->role;
            $user->status = Arr::has($validated, "status") ? $validated["status"] : $user->status;
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
            return redirect()->route("dashboard.users.index")->with("success", "User updated!");
        }
        return back()->withErrors("User not exists!");
    }

    public function destroy(string $id) {
        $user = User::find($id);
        if ($user) {
            if ($user == Auth::user()) {
                return back()->withErrors("You can't delete yourself!");
            }
            $user->media()->delete();
            $user->posts()->forceDelete();
            $user->comments()->forceDelete();
            if ($user->profile) {
                if (File::exists(public_path("uploads/author/".$user->profile))) {
                    File::delete(public_path("uploads/author/".$user->profile));
                }
            }
            $user->delete();
            return back()->with("success", "User deleted!");
        }
        return back()->withErrors("User not exists!");
    }

    public function status($id) {
        $user = User::find($id);
        if ($user) {
            if ($user == Auth::user()) {
                return back()->withErrors("You can't change your status!");
            }
            $user->status = $user->status ? "0" : "1";
            $user->save();
            $alert = $user->status ? "User activated!" : "User inactivated!";
            return back()->with("success", $alert);
        }
        return back()->withErrors("User not exists!");
    }
}
