<section class="authors">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 ">
                    <div class="authors-info">
                    <div class="image">
                        <a href="{{ route("frontend.user", $user->username) }}" class="image">
                            <img src="{{ asset("uploads/author/".($user->profile ?? "default.webp")) }}" alt="{{ $user->name }}"/>
                        </a>
                    </div>
                    <div class="content">
                        <h4>{{ $user->name }}</h4>
                        @if ($user->about)
                        <p>{{ $user->about }}</p>
                        @endif
                        <div class="social-media">
                            <ul class="list-inline">
                                @if ($user->facebook)
                                <li>
                                    <a href="{{ $user->facebook }}" target="_blank">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                @endif
                                @if ($user->twitter)
                                <li>
                                    <a href="{{ $user->twitter }}" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                @endif
                                @if ($user->instagram)
                                <li>
                                    <a href="{{ $user->instagram }}" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                @endif
                                @if ($user->linkedin)
                                <li>
                                    <a href="{{ $user->linkedin }}" target="_blank">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </li>
                                @endif
                                @if ($user->youtube)
                                <li>
                                    <a href="{{ $user->youtube }}" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
