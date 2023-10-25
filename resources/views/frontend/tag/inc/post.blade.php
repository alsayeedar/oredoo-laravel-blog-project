<div class="col-lg-8 oredoo-content">
    <div class="theiaStickySidebar">
        @forelse ($posts as $post)
        <div class="post-list post-list-style1 pt-0">
            <div class="post-list-image">
                <a href="{{ route("frontend.post", $post->slug) }}">
                    <img src="{{ asset("uploads/post/".$post->thumbnail) }}" alt="{{ $post->title }}">
                </a>
            </div>
            <div class="post-list-title">
                <div class="entry-title">
                    <h5>
                        <a href="{{ route("frontend.post", $post->slug) }}">{{ $post->title }}</a>
                    </h5>
                </div>
            </div>
            <div class="post-list-category">
                <div class="entry-cat">
                    <a href="{{ route("frontend.category", $post->category->slug) }}" class="category-style-1">{{ $post->category->title }}</a>
                </div>
            </div>
        </div>
        @empty
        <p>No post found!</p>
        @endforelse
        <div class="pagination">
            <div class="pagination-area">
                <div class="row">
                    <div class="col-lg-12">
                        {{ $posts->links("vendor.pagination.custom") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
