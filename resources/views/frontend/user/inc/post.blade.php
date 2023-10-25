<div class="col-lg-8 oredoo-content">
    <div class="theiaStickySidebar">
        @forelse ($posts as $post)
        <div class="post-list post-list-style4 {{ $loop->first ? "pt-0" : "" }}">
            <div class="post-list-image">
                <a href="{{ route("frontend.post", $post->slug) }}">
                    <img src="{{ asset("uploads/post/".$post->thumbnail) }}" alt="{{ $post->title }}"/>
                </a>
            </div>
            <div class="post-list-content">
                <ul class="entry-meta">
                    <li class="entry-cat">
                        <a href="{{ route("frontend.category", $post->category->slug) }}" class="category-style-1">{{ $post->category->title }}</a>
                    </li>
                    <li class="post-date"> <span class="line"></span>{{ $post->created_at->format("F d, Y") }}</li>
                </ul>
                <h5 class="entry-title">
                    <a href="{{ route("frontend.post", $post->slug) }}">{{ $post->title }}</a>
                </h5>
                <div class="post-btn">
                    <a href="{{ route("frontend.post", $post->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
        @empty
        <div>No post found!</div>
        @endforelse
        <div class="pagination">
            <div class="pagination-area text-left">
                {{ $posts->links("vendor.pagination.custom") }}
            </div>
        </div>
    </div>
</div>
