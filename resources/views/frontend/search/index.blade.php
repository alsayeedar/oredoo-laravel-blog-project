@extends("frontend.master")

@section("title", "Search results for ".$query." - ".config('app.sitesettings')::first()->site_title)

@section("content")
@include("frontend.search.inc.header")
<section class="section-feature-1">
    <div class="container-fluid">
        <div class="row">
            @include("frontend.search.inc.post")
            @include("frontend.search.inc.sidebar")
        </div>
    </div>
</section>
@endsection
