<div>
    <form wire:submit.prevent="{{ isset($post) ? 'updatePost' : 'store' }}" method="POST">
        @csrf
        @if (isset($post))
            @method('PUT')
        @endif
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model='title'
                    placeholder="Blog, Post, News or Event's title">
                @error('title')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
            <div class="col-sm-12 col-md-7">
                <select class="form-control selectric @error('category') is-invalid @enderror"
                    wire:model.lazy='category'>
                    <option value="">-- select post category --</option>
                    @foreach ($categories as $id => $category)
                        <option value="{{ $category->id }}" wire:key="{{ $id }}">
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0 pb-0">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
            <div class="col-sm-12 col-md-7" wire:ignore>
                <textarea class="summernote-simple @error('content') is-invalid @enderror" wire:model='content' id="content"></textarea>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-12 col-lg-3"></div>
            <div class="col-sm-12 col-md-7">
                @error('content')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
            <div class="col-sm-12 col-md-4">

                <div id="image-preview" class="image-preview @error('image') is-invalid @enderror" wire:ignore>
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" wire:model="image" id="image-upload" />
                </div>
                @error('image')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            @isset($post)
                <div class="col-sm-12 col-md-4">
                    <div id="image-previe" class="image-preview">
                        <img src="{{ asset($post->featured_image) }}" class="img-fluid" alt="{{ $post->slug }}"
                            srcset="">
                    </div>
                </div>
            @endisset
        </div>
        {{-- {{ auth()->user()->isAdmin() }} --}}
        @if (auth()->user()->role === 'ADM')
            <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Publish</label>
                <div class="col-sm-12 col-md-7">
                    <select class="form-control selectric @error('is_published') is-invalid @enderror"
                        wire:model='is_published'>
                        <option value="1">Publish</option>
                        <option value="0">Pending</option>
                    </select>
                    @error('is_published')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        @endif

        <div class="form-group row mb-4 @if (isset($post) && $post->is_published == true) d-none @endif">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="customCheck1">Draft</label>
            <div class="col-sm-12 col-md-7">
                {{-- <input type="checkbox" name="custom-switch-checkbox"  wire:model="is_draft" @if (isset($post) && $post->is_draft == true) checked @endif class="custom-switch-input"> --}}
                {{-- <span class="custom-switch-indicator"></span> --}}
                <label class="switch">
                    <input type="checkbox" wire:model="is_draft" @if (isset($post) && $post->is_draft == true) checked @endif>
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <button class="btn btn-primary mr-1" type="submit" wire:loading.attr="disabled"
                    wire:target="updatePost, store, image">
                    <span wire:target="updatePost, store"
                        wire:loading.remove>{{ isset($post) ? 'Update Post' : 'Create Post' }}</span>
                    <span wire:target="updatePost, store"
                        wire:loading>{{ isset($post) ? 'Updating...' : 'Creating..' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

@section('scripts')
    <script src="{{ asset('backend/assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('backend/assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/page/create-post.js') }}"></script>
    <script>
        $('#content').summernote({
            placeholder: 'Write about the post...',
            height: 300,
            // dialogsFade: true
            // toolbar: [
            //     ['style', ['style']],
            //     ['font', ['bold', 'underline', 'clear']],
            //     ['fontname', ['fontname']],
            // ['color', ['color']],
            // ['para', ['ul', 'ol', 'paragraph']],
            //     ['table', ['table']],
            //     ['insert', ['link', 'picture', 'video']],
            //     ['view', ['fullscreen', 'codeview', 'help']],
            // ],
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('content', contents);
                }
            }
        });

        var content = @json($content);

        document.addEventListener('livewire:load', function(event) {
            $('#content').summernote('code', content);
        });
    </script>
@endsection
