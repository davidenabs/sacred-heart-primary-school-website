@foreach ($comment->replies as $key => $comment)
    <div id="comment-reply-{{ $key }}" class="media mt-4 revealfade-left">
        <div style="width:30px; height:30px; border:2px solid rgb(255, 255, 255); display: table; text-align:center; background-color: lightgrey;"
            class="rounded-circle shadow mr-2">
            <span
                style="display:table-cell; vertical-align:middle; font-weight:700;">{{ Str::substr($comment->name, 0, 1) }}</span>
        </div>
        <div class="media-body">
            <h6>{{ $comment->name }}
                <small><i>{{ date('M d, Y \a\t h:ia', strtotime($comment->created_at)) }}</i></small></h6>
            <p>{{ $comment->content }}</p>
            <div class="d-flex justify-content-between">
                <a href="#comment-reply"class="btn btn-sm btn-light"
                    wire:click="repyId('{{ $comment->id }}', '{{ $comment->email }}')">Reply</a>
                @if ($is_admin)
                    <a href="javascript: void(0)" class="text-danger" wire:click="deleteComment('{{ $comment->id }}')"><i class="fa fa-trash"></i></a>
                @endif
            </div>
            @include('guest.includes.comment-replies', ['comments' => $post->replies])
        </div>
    </div>
@endforeach
