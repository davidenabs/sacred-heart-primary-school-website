<div>
    <form wire:submit.prevent="
    @if($isAddPhoto)
    addMorePhotos
    @else
    {{ isset($gallery) ? 'updateGallery' : 'upload' }}
    @endif
    " method="POST">
        @csrf
        @isset($gallery)
            @method('PUT')
        @endisset
        @if ($isAddPhoto)
        <fieldset>
            <div>
                <label class="form-label">Images* (You can only add a maximum of 10 photos per upload)</label>
                <div class="small text-danger">
                    {{ $err }}
                </div>
                @error('images.*')
                    <div class="small text-danger my-1">
                        {{ $message }}
                    </div>
                @enderror
                <div class="dropzone" id="mydropzone" wire:ignore>
                    <div class="fallback" :class="{ 'pointer-events-none cursor-default': isUploading }>
                        <input name="file" type="file" multiple />
                    </div>
                </div>
            </div>
        </fieldset>
        @include('admin.includes.button', ['title' => 'Add Photos', 'method'=>'addMorePhotos', 'loadingState' => 'Adding...'])
        @else
        <fieldset>
            <div class="form-group form-float">
                <div class="form-line">
                    <label class="form-label">Title*</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model='title'
                        placeholder="Gallery title">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group form-float">
                <div class="form-line">
                    <label class="form-label">Description*</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Give a description about the photos" wire:model='description' id="description"></textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </fieldset>
        @if (!isset($gallery))
        <fieldset>
            <div>
                <label class="form-label">Images* (You can only add a maximum of 10 photos per upload)</label>
                <div class="small text-danger">
                    {{ $err }}
                </div>
                @error('images.*')
                    <div class="small text-danger my-1">
                        {{ $message }}
                    </div>
                @enderror
                <div class="dropzone" id="mydropzone" wire:ignore>
                    <div class="fallback" :class="{ 'pointer-events-none cursor-default': isUploading }>
                        <input name="file" type="file" multiple />
                    </div>
                </div>
            </div>
        </fieldset>
        @endif
        @if (isset($gallery))
        @include('admin.includes.button', ['title' => 'Update Photos', 'method'=>'updateGallery', 'loadingState' => 'Updating...'])
        @else
        @include('admin.includes.button', ['title' => 'Upload Photos', 'method'=>'upload', 'loadingState' => 'Uploading...'])
        @endif
        @endif
    </form>
</div>

@section('scripts')
    <script src="{{ asset('backend/assets/bundles/dropzonejs/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/page/multiple-upload.js') }}"></script>
    <script>

    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/dropzonejs/dropzone.css') }}">
    <style>
        .pointer-events-none {
            pointer-events: none;
        }
        .cursor-default {
            cursor: default;
        }
    </style>
@endsection
