<div>
    <p><span class="font-weight-bold">Commenter: </span><span>{{ $comment->user ? $comment->user->name : $comment->name }}</span> <span class="badge bg-{{ $comment->user ? "success" : "warning" }}">{{ $comment->user ? "User" : "Guest" }}</span></p>
    <p><span class="font-weight-bold">Email: </span><span>{{ $comment->user ? $comment->user->email : $comment->email }}</span></p>
    <p><span class="font-weight-bold">Comment: </span><span>{{ $comment->message }}</span></p>
    <p><span class="font-weight-bold">Comment Type: </span><span class="badge bg-info">{{ !$comment->parent_id ? "Comment" : "Reply" }}</span></p>
    <p><span class="font-weight-bold">Post: </span><span>{{ $comment->post->title }}</span></p>
    <p><span class="font-weight-bold">Post Status: </span><span class="badge bg-{{ $comment->post->status ? "success" : "danger" }}">{{ $comment->post->status ? "Published" : "Draft" }}</span></p>
    <p><span class="font-weight-bold">Submitted On: </span><span>{{ $comment->created_at->format("d F, Y h:i:s A") }}</span></p>
</div>
