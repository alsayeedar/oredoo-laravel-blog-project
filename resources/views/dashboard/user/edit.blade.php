{{-- name username email password role status --}}
@extends('dashboard.master')
@section('title', 'Edit User')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.users.index") }}">All Users</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
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
                            <h3 class="card-title">Edit User</h3>
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
                            <form action="{{ route("dashboard.users.update", $user->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
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
                                            <textarea id="about" name="about" placeholder="Enter about" class="form-control">{{ $user->about }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mx-auto">
                                        <div class="form-group">
                                            <label for="image">Profile</label>
                                            <input type="file" class="form-control" id="image" name="profile" accept="image/*"/>
                                            <img id="imagepreview" src="{{ asset("uploads/author/".($user->profile ?? "default.webp")) }}" class="img-fluid img-thumbnail mt-3"/>
                                        </div>
                                        @if (auth()->user() != $user)
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="1" {{ $user->role == 1 ? "selected" : "" }}>Visitor</option>
                                                <option value="2" {{ $user->role == 2 ? "selected" : "" }}>Author</option>
                                                <option value="3" {{ $user->role == 3 ? "selected" : "" }}>Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option value="1" {{ $user->status == 1 ? "selected" : "" }}>Active</option>
                                                <option value="0" {{ $user->status == 0 ? "selected" : "" }}>Inactive</option>
                                            </select>
                                        </div>
                                        @endif
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
        function readURL(input) {
            if (input.files && input.files[0] && input.files[0].type.includes("image")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagepreview').removeClass("d-none");
                    $('#imagepreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $("#image").val('');
                $('#imagepreview').addClass("d-none");
                Swal.fire({
                    icon: "error",
                    text: "Select a valid image!"
                });
            }
        }
        $("#image").change(function(){
            readURL(this);
        });
    });
</script>
@endsection
