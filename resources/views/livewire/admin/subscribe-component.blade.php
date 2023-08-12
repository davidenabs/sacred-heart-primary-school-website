<div>
    <form wire:submit.prevent="{{ isset($subscribe) ? 'update' : 'store' }}" method="POST">
        @csrf
        @if (isset($subscribe))
            @method('PUT')
        @endif

        <div class="card-body">
            <div class="form-group row mb-4"">
                <label for="name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subscriber name
                    <sup class="text-danger"></sup></label>
                <div class="col-sm-12 col-md-7">
                    <input id="name" wire:model="name" type="text" placeholder="John Doe"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ isset($subscribe) ? old('name', $subscribe->name) : '' }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-4"">
                <label for="email" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Subscriber email
                    <sup class="text-danger"></sup></label>
                <div class="col-sm-12 col-md-7">
                    <input id="email" wire:model="email" placeholder="mail@sacredheartsch.com" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ isset($subscribe) ? old('email', $subscribe->email) : '' }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-4"">
                <label for="name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name of subscriber
                    <sup class="text-danger"></sup></label>
                <div class="col-sm-12 col-md-7">
                    <select wire:model="status" id="status"
                        class="form-control @error('status') is-invalid @enderror">
                        <option value="1" @if ($status === '1') selected @endif>Active
                        </option>
                        <option value="0" @if ($status === '0') selected @endif>Inactive
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>


        </div>
        <div class="card-footer text-right">
            <button class="btn btn-primary mr-1" type="submit" wire:loading.attr="disabled" wire:target="update"
                wire:target="store">
                <span wire:target="update" wire:target="store"
                    wire:loading.remove>{{ isset($subscribe) ? 'Update' : 'Save' }}</span>
                <span wire:target="update" wire:target="store"
                    wire:loading>{{ isset($subscribe) ? 'Updating...' : 'Saving..' }}</span>
            </button>
            <button class="btn btn-secondary" type="reset">Reset</button>
        </div>
    </form>
</div>
