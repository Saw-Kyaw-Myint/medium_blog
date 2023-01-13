@foreach ($comments as $comment)
    <div class="display-comment {{ $comment->parent_id != null ? 'mg-3' : ' ' }}">
        <div class="reply">
            <div class="reply-header clearfix">
                <div class="reply-profile">
                    <img src="{{ asset('storage/' . $comment->user->profile) }}" alt="" width="20px"
                        height="20px">
                </div>
                <div class="left-detail">
                    <h3>{{ $comment->user->name == $post->user->name ? 'ADMIN' : strtoupper($comment->user->name) }}
                    </h3>
                    <p>{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <p class="reply-text" ondblclick="edit( {{ $comment->id }})">{{ $comment->comment }}</p>
            @if (Auth::user())
                <form action="{{ route('comment.update', $comment->id) }}" method="post" id="{{ $comment->id }}"
                    class="edit-form">
                    @csrf
                    @method('put')
                    <input type="text" id="edit-comtext" class="reply{{ $comment->id }}"
                        value="{{ $comment->comment }}" name="comment" onblur="closeEdit()"></input>
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                    @if ($comment->parent_id != null)
                        <input type="hidden" name="parent_id" value="{{ $comment->parent_id }}" />
                    @endif
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                </form>
            @endif

            <div id="ex{{ $comment->id }}" class="modal">
                <div class="reply-form">
                    <form method="post" action="{{ route('reply.add') }}">
                        @csrf
                        <div class="form-group">
                            <textarea type="text" name="comment" class="reply-box">{{ trim($comment->user->name == $post->user->name ? 'ADMIN' : strtoupper($comment->user->name)) }}</textarea>
                            <input type="hidden" name="post_id" value="{{ $post_id }}" />
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="reply-btn" style="font-size: 0.8em;" value="Reply" />
                        </div>
                    </form>
                </div>
            </div>
            @if (Auth::user())
                <div class="comment-btn-group">
                    <a href="/delete/{{ $comment->id }}" class="delete-comment">delete </a>
                    <p><a href="#ex{{ $comment->id }}" class="comment-reply" rel="modal:open">reply</a></p>
                </div>
            @endif


        </div>

        @include('post.partials.replies', ['comments' => $comment->replies])
    </div>
@endforeach
