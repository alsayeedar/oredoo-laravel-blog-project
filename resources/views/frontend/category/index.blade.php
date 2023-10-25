@extends("frontend.master")

@section("title", $category->title." - ".config('app.sitesettings')::first()->site_title)

@section("content")
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>{{ $category->title }}</h1>
                         <p class="links"><a href="{{ route("frontend.home") }}">Home <i class="las la-angle-right"></i></a> {{ $category->title }}</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>
<section class="blog-layout-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @forelse ($posts as $post)
                <div class="post-list post-list-style2">
                    <div class="post-list-image">
                        <a href="{{ route("frontend.post", $post->slug) }}">
                            <img src="{{ asset("uploads/post/".$post->thumbnail) }}" alt="{{ $post->title }}"/>
                        </a>
                    </div>
                    <div class="post-list-content">
                        <h3 class="entry-title">
                            <a href="{{ route("frontend.post", $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <ul class="entry-meta">
                            <li class="post-author-img"><img src="{{ asset("uploads/author/".($post->user->profile ?? "default.webp")) }}" alt="{{ $post->user->name }}"/></li>
                            <li class="post-author"> <a href="{{ route("frontend.user", $post->user->username) }}">{{ $post->user->name }}</a></li>
                            <li class="entry-cat"><a href="{{ route("frontend.category", $post->category->slug) }}" class="category-style-1"><span class="line"></span>{{ $post->category->title }}</a></li>
                            <li class="post-date"><span class="line"></span>{{ $post->created_at->format("F d, Y") }}</li>
                        </ul>
                        <div class="post-exerpt">
                            <p>{{ $str::words(strip_tags($post->content), 20) }}</p>
                        </div>
                        <div class="post-btn">
                            <a href="{{ route("frontend.post", $post->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
                @empty
                <div>No post found!</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
<div class="pagination">
    <div class="container-fluid">
        <div class="pagination-area">
            <div class="row">
                <div class="col-lg-12">
                    {{ $posts->links("vendor.pagination.custom") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
