@extends('dashboard.master')
@section('title', 'Profile')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                @foreach ($errors->all() as $error)
                                <p class="m-0">{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif
                            @if (session("success"))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                <p class="m-0">{{ session("success") }}</p>
                            </div>
                            @endif
                            <form action="{{ route("dashboard.settings.profile.update") }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="profile">Profile Photo</label>
                                            <img width="120px" id="profilepreview" height="120px" src="{{ asset("uploads/author/".($user->profile ?? "default.webp")) }}" class="d-block rounded rounded-circle mb-2"/>
                                            <input type="file" class="form-control" id="profile" name="profile" accept="image/*"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ $user->name }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="{{ $user->username }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ $user->email }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="about">About</label>
                                            <textarea class="form-control" id="about" name="about" rows="4">{{ $user->about }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mx-auto">
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <input type="url" class="form-control" id="facebook" name="facebook" placeholder="Enter facebook profile link" value="{{ $user->facebook }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            <input type="url" class="form-control" id="twitter" name="twitter" placeholder="Enter twitter profile link" value="{{ $user->twitter }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <input type="url" class="form-control" id="instagram" name="instagram" placeholder="Enter instagram profile link" value="{{ $user->instagram }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="linkedin">LinkedIn</label>
                                            <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="Enter linkedin profile link" value="{{ $user->instagram }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="youtube">YouTube</label>
                                            <input type="url" class="form-control" id="youtube" name="youtube" placeholder="Enter youtube profile link" value="{{ $user->youtube }}"/>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section("script")
<script src="{{ asset("assets/dashboard/plugins/sweetalert2/sweetalert2.all.js") }}"></script>
<script>
    $(document).ready(function() {
        function readURL(input, preview, image) {
            if (input.files && input.files[0] && input.files[0].type.includes("image")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(preview).removeClass("d-none");
                    $(preview).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $(image).val('');
                $(preview).addClass("d-none");
                Swal.fire({
                    icon: "error",
                    text: "Select a valid image!"
                });
            }
        }
        $("#profile").change(function(){
            readURL(this, "#profilepreview", "#profile");
        });
    });
</script>
@endsection
