<div class="widget">
    <div class="widget-title">
        <h5>Tags</h5>
    </div>
    <div class="widget-tags">
        <ul class="list-inline">
            @forelse ($tags as $tag)
            <li>
                <a href="{{ route("frontend.tag", $str::slug($tag->name)) }}">{{ $tag->name }}</a>
            </li>
            @empty
            <div>No tag found!</div>
            @endforelse
        </ul>
    </div>
</div>
