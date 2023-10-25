<header class="header navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <div class="header-area">
            <div class="logo">
                <a href="{{ route("frontend.home") }}">
                    <img src="{{ asset("uploads/logo/".$sitesettings->logo_light) }}" alt="{{ $sitesettings->site_title }}" class="logo-dark"/>
                    <img src="{{ asset("uploads/logo/".$sitesettings->logo_dark) }}" alt="{{ $sitesettings->site_title }}" class="logo-white"/>
                </a>
            </div>
            <div class="header-navbar">
                <nav class="navbar">
                    <div class="collapse navbar-collapse" id="main_nav">
                        @if (count($menu) > 0)
                        <ul class="navbar-nav">
                            @foreach ($menu as $item)
                            <li class="nav-item">
                                <a class="nav-link{{ request()->url() == $item["href"] ? " active" : "" }}" href="{{ $item["href"] }}">{{ $item["text"] }}</a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </nav>
            </div>
            <div class="header-right">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox" />
                        <span class="slider round ">
                            <i class="lar la-sun icon-light"></i>
                            <i class="lar la-moon icon-dark"></i>
                        </span>
                    </label>
                </div>
                <div class="search-icon">
                    <i class="las la-search"></i>
                </div>
                @auth
                <div class="botton-sub">
                    <a href="{{ route("dashboard.home") }}" class="btn-subscribe">Dashboard</a>
                </div>
                @else
                <div class="botton-sub">
                    <a href="{{ route("auth.login") }}" class="btn-subscribe">Log In</a>
                </div>
                @endauth
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </div>
</header>
