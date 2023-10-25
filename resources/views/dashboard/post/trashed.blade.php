@extends('dashboard.master')
@section('title', 'Trashed Posts')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trashed Posts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.posts.index") }}">All Posts</a></li>
                        <li class="breadcrumb-item active">Trashed Posts</li>
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
                            <h3 class="card-title">Trashed Posts</h3>
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
                                            <th class="text-center">Author</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Tags</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Featured</th>
                                            <th class="text-center">Comment Status</th>
                                            <th class="text-center">Views</th>
                                            <th class="text-center">Comment Count</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($posts as $post)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + $posts->firstItem() }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td class="text-center">{{ $post->user->name }}</td>
                                            <td class="text-center">{{ $post->category->title }}</td>
                                            <td class="text-center">
                                                @forelse ($post->tags as $tag)
                                                <span class="badge bg-primary">{{ $tag->name }}</span>
                                                @empty
                                                <span class="badge bg-danger">Empty</span>
                                                @endforelse
                                            </td>
                                            <td class="text-center"><span class="badge bg-{{ $post->status ? "success" : "danger" }}">{{ $post->status ? "Published" : "Draft" }}</span></td>
                                            <td class="text-center"><span class="badge bg-{{ $post->is_featured ? "success" : "danger" }}">{{ $post->is_featured ? "Yes" : "No" }}</span></td>
                                            <td class="text-center"><span class="badge bg-{{ $post->enable_comment ? "success" : "danger" }}">{{ $post->enable_comment ? "Enable" : "Disable" }}</span></td>
                                            <td class="text-center">{{ $post->views }}</td>
                                            <td class="text-center">{{ $post->comments_count }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route("dashboard.posts.restore", $post->id) }}" class="btn btn-success">Restore</a>
                                                    <form action="{{ route("dashboard.posts.delete", $post->id) }}" method="POST">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger deletebtn">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="11" class="text-center">No post found!</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                            {{ $posts->links() }}
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
