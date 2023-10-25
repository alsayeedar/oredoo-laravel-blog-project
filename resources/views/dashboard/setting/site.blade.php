@extends('dashboard.master')
@section('title', 'Site Settings')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Site Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Site Settings</li>
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
                            <h3 class="card-title">Site Settings</h3>
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
                            <form action="{{ route("dashboard.settings.site.update") }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mx-auto">
                                        <div class="form-group">
                                            <label for="site_title">Site Title</label>
                                            <input type="text" class="form-control" id="site_title" name="site_title" placeholder="Enter site title" value="{{ $sitesettings->site_title }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="tagline">Tagline</label>
                                            <input type="text" class="form-control" id="tagline" name="tagline" placeholder="Enter tagline" value="{{ $sitesettings->tagline }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea id="description" name="description" placeholder="Enter description" class="form-control">{{ $sitesettings->description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="logo_dark">Logo Dark <span class="font-italic">(For dark mode)</span></label>
                                            <img id="logo_darkpreview" src="{{ asset("uploads/logo/".$sitesettings->logo_dark) }}" class="d-block mb-3 img-fluid img-thumbnail bg-black"/>
                                            <input type="file" class="form-control" id="logo_dark" name="logo_dark" accept="image/*"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="logo_light">Logo Light <span class="font-italic">(For light mode)</span></label>
                                            <img id="logo_lightpreview" src="{{ asset("uploads/logo/".$sitesettings->logo_light) }}" class="d-block mb-3 img-fluid img-thumbnail"/>
                                            <input type="file" class="form-control" id="logo_light" name="logo_light" accept="image/*"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="copyright_text">Copyright Text</label>
                                            <textarea id="copyright_text" name="copyright_text" placeholder="Enter copyright text" class="form-control">{{ $sitesettings->copyright_text }}</textarea>
                                        </div>
                                        <div class="align-items-center d-flex form-group">
                                            <label for="enable_registration" class="mr-4">Enable Registration</label>
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" name="enable_registration" id="enable_registration" value="1" {{ $sitesettings->enable_registration ? "checked" : "" }}/>
                                                <label for="enable_registration"></label>
                                            </div>
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
        $("#logo_dark").change(function(){
            readURL(this, "#logo_darkpreview", "#logo_dark");
        });
        $("#logo_light").change(function(){
            readURL(this, "#logo_lightpreview", "#logo_light");
        });
    });
</script>
@endsection
