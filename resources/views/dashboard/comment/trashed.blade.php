@extends('dashboard.master')
@section('title', 'Trashed Comments')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trashed Comments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.comments.index') }}">All Comments</a></li>
                        <li class="breadcrumb-item active">Trashed Comments</li>
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
                            <h3 class="card-title">Trashed Comments</h3>
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
                                            <th class="text-center">Commenter</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Post</th>
                                            <th class="text-center">Comment</th>
                                            <th class="text-center">Submitted On</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($comments as $comment)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + $comments->firstItem() }}</td>
                                            <td>{{ $comment->user ? $comment->user->name : $comment->name }}</td>
                                            <td class="text-center"><span class="badge bg-{{ $comment->user ? "success" : "warning" }}">{{ $comment->user ? "User" : "Guest" }}</span></td>
                                            <td class="text-center">{{ $comment->post->title ?? "Deleted" }}</td>
                                            <td class="text-center">{{ $comment->message }}</td>
                                            <td class="text-center">
                                                <div>{{ $comment->created_at->format("d M, Y") }}</div>
                                                <div>{{ $comment->created_at->format("h:i:s A") }}</div>
                                            </td>
                                            <td class="text-center"><span class="badge bg-{{ $comment->status ? "success" : "warning" }}">{{ $comment->status ? "Published" : "Pending" }}</span></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route("dashboard.comments.restore", $comment->id) }}" class="btn btn-success">Restore</a>
                                                    <form action="{{ route("dashboard.comments.delete", $comment->id) }}" method="POST">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger deletebtn">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No comments found!</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                            {{ $comments->links() }}
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
<script>
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
