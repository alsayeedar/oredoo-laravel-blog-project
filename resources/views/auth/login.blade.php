@extends("frontend.master")

@section("title", "Log In - ".config("app.name"))
@section("content")
<section class="login p-0 py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Log In</h4>
                    @if ($errors->any())
                    <div class="alert alert-danger rounded-0">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                    </div>
                    @endif
                    <form  action="{{ route("auth.login") }}" class="sign-form widget-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email or Username*" name="email_or_username" value="{{ old("email_or_username") }}"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password"/>
                        </div>
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" value="1" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember Me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Log In</button>
                        </div>
                        <p class="form-group text-center">Don't have an account? <a href="{{ route("auth.signup") }}" class="btn-link">Create One</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
