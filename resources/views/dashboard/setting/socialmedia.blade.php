@extends('dashboard.master')
@section('title', 'Social Media')

@section('content')
<div class="modal fade" id="addMedia" tabindex="-1" aria-labelledby="ModalLabelTitle" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route("dashboard.settings.social.media.add") }}" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Add Social Media</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" placeholder="e.g. Facebook" id="title" name="title" class="form-control" required=""/>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Icon" id="icon" name="icon" required=""/>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="url" placeholder="Link" id="link" name="link" class="form-control" required=""/>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" id="color" name="color" class="form-control" required=""/>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-control" required="">
                            <option value="1">Active</option>
                            <option value="0">Inctive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Social Media</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Social Media</li>
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
                            <div class="align-items-center d-flex justify-content-between">
                                <h3 class="card-title">Social Media</h3><button data-toggle="modal" data-target="#addMedia" class="btn btn-primary btn-sm font-weight-bold">Add New</button>
                            </div>
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
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Icon</th>
                                            <th class="text-center">Link</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($socialmedia as $media)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + $socialmedia->firstItem() }}</td>
                                            <td class="text-center">{{ $media->title }}</td>
                                            <td class="text-center"><i class="{{ $media->icon }} fa-2x" style="color: {{ $media->color }}"></i></td>
                                            <td class="text-center">{{ $media->link }}</td>
                                            <td class="text-center"><a href="{{ route("dashboard.settings.social.media.status", $media->id) }}"><span class="badge bg-{{ $media->status ? "success" : "warning" }}">{{ $media->status ? "Active" : "Inactive" }}</span></a></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <form action="{{ route("dashboard.settings.social.media.delete", $media->id) }}" method="POST">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger deletebtn">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No social media found!</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                            {{ $socialmedia->links() }}
                            </ul>
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
<script src="{{ asset("assets/dashboard/plugins/iconpicker/iconpicker.min.js") }}"></script>
<script>
    $(document).ready(function() {
        $('#addMedia').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        });
        (async () => {
            const response = await fetch('{{ route("api.icons") }}')
            const result = await response.json()

            new Iconpicker(document.querySelector("#icon"), {
                icons: result
            })
        })();
    });
    $('.deletebtn').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            title: 'Are you sure?',
            type: 'warning',
            icon: 'warning',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        });
    });
</script>
@endsection
