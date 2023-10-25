<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    public function index() {
        $sitesettings = SiteSetting::first();
        return view("dashboard.setting.site", compact("sitesettings"));
    }

    public function update(Request $request) {
        $validated = $request->validate([
            "site_title" => ["required", "string", "min:2", "max:255"],
            "tagline" => ["required", "string", "min:2", "max:255"],
            "description" => ["required", "string", "min:2", "max:300"],
            "copyright_text" => ["required", "string", "min:2", "max:300"],
            "enable_registration" => ["nullable", "integer"],
            "logo_dark" => ["nullable", "image"],
            "logo_light" => ["nullable", "image"],
        ]);
        $sitesettings = SiteSetting::first();
        $sitesettings->site_title = $validated["site_title"];
        $sitesettings->tagline = $validated["tagline"];
        $sitesettings->description = $validated["description"];
        $sitesettings->copyright_text = $validated["copyright_text"];
        $sitesettings->enable_registration = Arr::has($validated, "enable_registration") ? "1" : "0";
        if (Arr::has($validated, "logo_dark")) {
            $image = $request->file("logo_dark");
            $imageName = "logo_dark_".Str::random(5).".".$image->extension();
            $image->move(public_path("uploads/logo"), $imageName);
            if (File::exists(public_path("uploads/logo/".$sitesettings->logo_dark))) {
                File::delete(public_path("uploads/logo/".$sitesettings->logo_dark));
            }
            $sitesettings->logo_dark = $imageName;
        }
        if (Arr::has($validated, "logo_light")) {
            $image = $request->file("logo_light");
            $imageName = "logo_light_".Str::random(5).".".$image->extension();
            $image->move(public_path("uploads/logo"), $imageName);
            if (File::exists(public_path("uploads/logo/".$sitesettings->logo_light))) {
                File::delete(public_path("uploads/logo/".$sitesettings->logo_light));
            }
            $sitesettings->logo_light = $imageName;
        }
        $sitesettings->save();
        return back()->with("success", "Site Settings updated!");
    }
}
