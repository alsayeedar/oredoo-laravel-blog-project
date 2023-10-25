<div class="footer">
    <div class="footer-area">
        <div class="footer-area-content">
            <div class="container">
                <div class="row ">
                    @if (count($menu) > 0)
                    <div class="col-md-3">
                        <div class="menu">
                            <h6>Menu</h6>
                            <ul>
                                @foreach ($menu as $item)
                                <li><a href="{{ $item["href"] }}">{{ $item["text"] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6 text-center">
                        <img src="{{ asset("uploads/logo/".$sitesettings->logo_dark) }}" alt="{{ $sitesettings->site_title }}" class="logo-white"/>
                        <p class="text-white text-justify mt-2">{{ $sitesettings->description }}</p>
                    </div>
                    @if ($socialmedia->count() > 0)
                    <div class="col-md-3">
                        <div class="menu">
                            <h6>Follow Us</h6>
                            <ul>
                                @foreach ($socialmedia as $media)
                                <li><a href="{{ $media->link }}" target="_blank">{{ $media->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="footer-area-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright">
                            <p>{{ $sitesettings->copyright_text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
