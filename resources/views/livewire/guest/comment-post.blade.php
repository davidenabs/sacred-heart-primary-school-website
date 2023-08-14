<div class="mb-5" id="comment">
    <h4 class="mb-4">{{ $comments->count() }} {{ Str::plural('Comment', $comments->count()) }}</h4>
    @forelse ($comments as $key => $comment)
        <div id="comment-{{ $key }}" class="media mb-4 revealfade-right">
            @if (0)
                <img src="{{ $comment->user->profile_photo_url }}" class="rounded-circle mr-3 mt-1" style="width: 45px;"
                    alt="{{ $comment->user->name . '- Sacred Heart Primary School' }}">
            @else
                <div style="width:30px; height:30px; border:2px solid rgb(255, 255, 255); display: table; text-align:center; background-color: lightgrey;"
                    class="rounded-circle shadow mr-2">
                    <span
                        style="display:table-cell; vertical-align:middle; font-weight:700;">{{ Str::substr($comment->name, 0, 1) }}</span>
                </div>
            @endif
            <div class="media-body">
                <h6>{{ $comment->name }}
                    <small><i>{{ date('M d, Y \a\t h:ia', strtotime($comment->created_at)) }}</i></small></h6>
                <p>{{ $comment->content }}</p>
                <div class="d-flex justify-content-between">
                    <a href="#comment-reply" class="btn btn-sm btn-light"
                        wire:click="repyId('{{ $comment->id }}', '{{ $comment->email }}')">Reply</a>
                    @if ($is_admin)
                        <a href="javascript: void(0)" class="text-danger"
                            wire:click="deleteComment('{{ $comment->id }}')"><i class="fa fa-trash"></i></a>
                    @endif
                </div>

                @include('guest.includes.comment-replies')

            </div>
        </div>
    @empty
        <p class="p-4 text-center text-muted">No comments yet. Be the first to add a comment</p>
    @endforelse

    <div class="{{ $is_admin ? 'rounded-lg border' : 'bg-white' }} p-2 rounded shadow-sm revealfade-bottom" id="comment-reply">
        <h5 class="mb-4">Leave a comment</h5>
        <form wire:submit.prevent="storeComment()" method="POST">
            @csrf
            @if (!$is_admin)
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" name="name" wire:model="name" class="form-control" id="name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" wire:model="email" class="form-control" id="email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="comment" wire:model="content" cols="30" rows="5" class="form-control"></textarea>
                @error('content')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            @if (!$is_admin)
                <div class="row">
                    <div class="col form-group">
                        <input type="checkbox" name="follow" wire:model="follow">
                        Notify me
                    </div>
                </div>
            @endif
            <div class="form-group mb-0">
                <button type="submit" wire:target="storeComment" wire:loading.attr="disabled"
                    class="btn px-3  {{ $is_admin ? 'btn-primary' : 'shs-bg-primary-color' }} text-white">
                    <span wire:target="storeComment" wire:loading.remove>Comment</span>
                    <span wire:target="storeComment" wire:loading>...</span>
                </button>
            </div>
        </form>
    </div>
</div>
