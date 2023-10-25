<div class="post-single-author">
    <div class="authors-info">
        <div class="image">
            <a href="{{ route("frontend.user", $post->user->username) }}" class="image">
                <img src="{{ asset("uploads/author/".($post->user->profile ?? "default.webp")) }}" alt="{{ $post->user->name }}"/>
            </a>
        </div>
        <div class="content">
            <a href="{{ route("frontend.user", $post->user->username) }}"><h4>{{ $post->user->name }}</h4></a>
            @if ($post->user->about)
            <p>{{ $post->user->about }}</p>
            @endif
            <div class="social-media">
                <ul class="list-inline">
                    <li>
                        <a href="#">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" >
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" >
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
