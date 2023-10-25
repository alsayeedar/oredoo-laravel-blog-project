@extends("frontend.master")

@section("title", "Sign Up - ".config("app.name"))
@section("content")
<section class="login p-0 py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    @if ($enable_registration)
                    <h4>Sign Up</h4>
                    @if ($errors->any())
                    <div class="alert alert-danger rounded-0">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                    </div>
                    @endif
                    <form action="{{ route("auth.signup") }}" class="sign-form widget-form contact_form" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Full Name*" name="name" value="{{ old("name") }}"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username*" name="username" value="{{ old("username") }}"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address*" name="email" value="{{ old("email") }}"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value=""/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password*" name="password_confirmation" value=""/>
                        </div>
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                                <input name="agree" value="1" type="checkbox" class="custom-control-input" id="rememberMe"/>
                                <label class="custom-control-label" for="rememberMe">Agree to our <a href="#" class="btn-link">terms & conditions</a> </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center">Already have an account? <a href="{{ route("auth.login") }}" class="btn-link">Log In</a> </p>
                    </form>
                    @else
                    <div class="alert alert-danger rounded-0 m-0">
                        <span>User registration is currently not allowed!</span>
                    </div>
                    @endif
                </div>
            </div>
         </div>
    </div>
</section>
@endsection
