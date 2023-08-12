<div>
    <form wire:submit.prevent="{{ isset($category) ? 'updateCategory' : 'store' }}" method="POST">
        @csrf
        @if (isset($category))
            @method('PUT')
        @endif
        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
            <div class="col-sm-12 col-md-7">
                <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model='title'
                    placeholder="Category title">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
            <div class="col-sm-12 col-md-7">
                <textarea wire:model='description' class="form-control @error('description') is-invalid @enderror" id="description"></textarea>
                @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>
        </div>

        <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
                <button class="btn btn-primary mr-1" type="submit"
                        wire:loading.attr="disabled"
                        wire:target="updateCategory"
                        wire:target="store">
                    <span wire:target="updateCategory" wire:target="store"
                        wire:loading.remove>{{ isset($category) ? 'Update Category' : 'Create Category' }}</span>
                    <span wire:target="updateCategory" wire:target="store"
                        wire:loading>{{ isset($category) ? 'Updating...' : 'Creating..' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>


