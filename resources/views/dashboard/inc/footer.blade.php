<footer class="main-footer">
    <strong>Copyright &copy; 2022-{{ date("Y") }} <a href="{{ route("frontend.home") }}">{{ config('app.sitesettings')::first()->site_title }}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
    </div>
</footer>
