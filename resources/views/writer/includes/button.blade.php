{{-- <div class="form-group row mb-4">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
    <div class="col-sm-12 col-md-7">
        <button class="btn btn-primary mr-1" type="submit" wire:loading.attr="disabled"
            wire:target="updatePost, upload">
            <span wire:target="updatePost, upload"
                wire:loading.remove>{{ isset($post) ? 'Update Photos' : 'Upload Photos' }}</span>
            <span wire:target="updatePost, upload"
                wire:loading>{{ isset($post) ? 'Updating...' : 'Uploading...' }}</span>
        </button>
    </div> --}}

    <div class="mb-4 float-right">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
        <div class="col-sm-12 col-md-12">
            <button class="btn btn-primary" type="submit" wire:loading.attr="disabled"
                wire:target="{{ $method }}">
                <span wire:target="{{ $method }}"
                    wire:loading.remove>{{ $title }}</span>
                <span wire:target="{{ $method }}"
                    wire:loading>{{ $loadingState }}</span>
            </button>
        </div>