@if ($post->enable_comment)
<div class="post-single-comments">
    @if ($post->comments_count > 0)
    <h4>{{ $post->comments_count }} Comments</h4>
    <ul class="comments">
        @foreach ($post->comments as $comment)
        <li class="comment-item {{ $loop->first ? "pt-0" : "" }}">
            <div class="d-flex">
                <img src="{{ asset("uploads/author/".($comment->user && $comment->user->profile ? $comment->user->profile : "default.webp")) }}" alt="{{ $comment->user->name ?? $comment->name }}"/>
                <div class="content">
                    <div class="meta">
                        <ul class="list-inline">
                            @if ($comment->user)
                            <li><a href="{{ route("frontend.user", $comment->user->username) }}">{{ $comment->user->name }}</a></li>
                            @else
                            <li>{{ $comment->name }}</li>
                            @endif
                            @if ($comment->user && $comment->user == $post->user)<span class="badge bg-success ml-2 p-1 text-white">Post Creator</span>@endif
                            <li class="slash"></li>
                            <li>{{ $comment->created_at->diffForHumans() }}</li>
                        </ul>
                    </div>
                    <p>{{ $comment->message }}</p>
                    <a href="#" data-comment-id="{{ $comment->id }}" class="btn-reply"><i class="las la-reply"></i> Reply</a>
                </div>
            </div>
            @if (count($comment->replies) > 0)
            <ul class="comments replies ml-3 ml-md-5">
                @foreach ($comment->replies as $reply)
                <li class="comment-item">
                    <div class="d-flex">
                        <img src="{{ asset("uploads/author/".($reply->user && $reply->user->profile ? $reply->user->profile : "default.webp")) }}" alt="{{ $reply->user->name ?? $reply->name }}"/>
                        <div class="content">
                            <div class="meta">
                                <ul class="list-inline">
                                    @if ($reply->user)
                                    <li><a href="{{ route("frontend.user", $reply->user->username) }}">{{ $reply->user->name }}</a></li>
                                    @else
                                    <li>{{ $reply->name }}</li>
                                    @endif
                                    @if ($reply->user && $reply->user == $post->user)<span class="badge bg-success ml-2 p-1 text-white">Post Creator</span>@endif
                                    <li class="slash"></li>
                                    <li>{{ $reply->created_at->diffForHumans() }}</li>
                                </ul>
                            </div>
                            <p>{{ $reply->message }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
    </ul>
    @endif
    <div id="comment-form-location">
        <div class="comments-form" id="comment-form">
            <h4 >Leave a Reply</h4>
            <form class="form" action="{{ route("frontend.comment", $post->id) }}" method="POST" id="main_contact_form">
                @guest
                <p>Your email adress will not be published, Requied fileds are marked*.</p>
                @endguest
                @if (session("success"))
                <div class="alert alert-success contact_msg rounded-0">
                    {{ session("success") }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger rounded-0">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                </div>
                @endif
                <div class="row">
                    @csrf
                    @guest
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name*" required="required" value="{{ old("name") }}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required="required" value="{{ old("email") }}"/>
                        </div>
                    </div>
                    @endguest
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message*" required="required">{{ old("message") }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn-custom">Comment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@section("script")
<script>
    var replyUrl = '{{ route("frontend.comment.reply") }}';
</script>
@endsection
@endif
