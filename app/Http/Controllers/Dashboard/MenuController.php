<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function header() {
        $menu = Menu::first()->header_menu;
        return view("dashboard.setting.menu.header", compact("menu"));
    }

    public function footer() {
        $menu = Menu::first()->footer_menu;
        return view("dashboard.setting.menu.footer", compact("menu"));
    }

    public function headerUpdate(Request $request) {
        $validated = $request->validate([
            "menudata" => ["required", "json"],
        ]);
        $menu = Menu::first();
        $menu->header_menu = $validated["menudata"];
        $menu->save();
        return back()->with("success", "Header menu updated!");
    }

    public function footerUpdate(Request $request) {
        $validated = $request->validate([
            "menudata" => ["required", "json"],
        ]);
        $menu = Menu::first();
        $menu->footer_menu = $validated["menudata"];
        $menu->save();
        return back()->with("success", "Footer menu updated!");
    }
}
