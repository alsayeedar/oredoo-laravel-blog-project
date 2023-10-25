@if ($featuredposts->count() > 0)
<section class="blog blog-home4 d-flex align-items-center justify-content-center">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel">
                    @foreach ($featuredposts as $featuredpost)
                    <div class="blog-item" style="background-image: url('{{ asset("uploads/post/".$featuredpost->thumbnail) }}')">
                        <div class="blog-banner">
                            <div class="post-overly">
                                <div class="post-overly-content">
                                    <div class="entry-cat">
                                        <a href="{{ route("frontend.category", $featuredpost->category->slug) }}" class="category-style-2">{{ $featuredpost->category->title }}</a>
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{ route("frontend.post", $featuredpost->slug) }}">{{ $featuredpost->title }}</a>
                                    </h2>
                                    <ul class="entry-meta">
                                        <li class="post-author"> <a href="{{ route("frontend.user", $featuredpost->user->username) }}">{{ $featuredpost->user->name }}</a></li>
                                        <li class="post-date"> <span class="line"></span>{{ $featuredpost->created_at->format("F d, Y") }}</li>
                                        <li class="post-timeread"> <span class="line"></span>{{ $featuredpost->readTime() }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif
