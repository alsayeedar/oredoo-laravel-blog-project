@extends("frontend.master")

@section("title", "Posts tagged ".$tag." - ".config('app.sitesettings')::first()->site_title)

@section("content")
@include("frontend.tag.inc.header")
<section class="section-feature-1">
    <div class="container-fluid">
        <div class="row">
            @include("frontend.tag.inc.post")
            @include("frontend.tag.inc.sidebar")
        </div>
    </div>
</section>
@endsection
