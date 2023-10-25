<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index() {
        $pages = Page::orderBy("id", "DESC")->paginate(20);
        return view("dashboard.page.index", compact("pages"));
    }

    public function status($id) {
        $page = Page::find($id);
        if ($page) {
            $page->status = $page->status ? "0" : "1";
            $page->save();
            $alert = $page->status ? "Page published!" : "Page drafted!";
            return back()->with("success", $alert);
        }
        return back()->withErrors("Page not exists!");
    }

    public function create() {
        return view("dashboard.page.add");
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "title" => ["required", "string", "max:255"],
            "slug" => ["required", "string", "max:255", "unique:pages,slug"],
            "content" => ["required", "string"],
            "status" => ["required", Rule::in(["0", "1"])],
        ]);
        Page::create($validated);
        return redirect()->route("dashboard.pages.index")->with("success", "Page created!");
    }

    public function edit(string $id) {
        $page = Page::find($id);
        if ($page) {
            return view("dashboard.page.edit", compact("page"));
        }
        return back()->withErrors("Page not exists!");
    }

    public function update(Request $request, string $id) {
        $page = Page::find($id);
        if ($page) {
            $validated = $request->validate([
                "title" => ["required", "string", "max:255"],
                "slug" => ["required", "string", "max:255", Rule::unique("pages", "slug")->ignore($page->id)],
                "content" => ["required", "string"],
                "status" => ["required", Rule::in(["0", "1"])],
            ]);
            $page->title = $validated["title"];
            $page->slug = Str::slug($validated["slug"]);
            $page->content = $validated["content"];
            $page->status = $validated["status"];
            $page->save();
            return redirect()->route("dashboard.pages.index")->with("success", "Page updated!");
        }
        return redirect()->route("dashboard.pages.index")->withErrors("Page not exists!");
    }
    public function destroy(string $id) {
        $page = Page::find($id);
        if ($page) {
            $page->delete();
            return back()->with("success", "Page deleted!");
        }
        return back()->withErrors("Page not exists!");
    }

    public function trashed() {
        $pages = Page::onlyTrashed()->orderBy("id", "DESC")->paginate(20);
        return view("dashboard.page.trashed", compact("pages"));
    }

    public function restore($id) {
        $page = Page::onlyTrashed()->find($id);
        if ($page) {
            $page->restore();
            return back()->with("success", "Page restored!");
        }
        return back()->withErrors("Page not exists!");
    }

    public function delete($id) {
        $page = Page::onlyTrashed()->find($id);
        if ($page) {
            $page->forceDelete();
            return back()->with("success", "Page deleted!");
        }
        return back()->withErrors("Page not exists!");
    }
}
