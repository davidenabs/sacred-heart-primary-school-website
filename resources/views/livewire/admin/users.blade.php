<div>
    <form wire:submit.prevent="{{ isset($user) ? 'update' : 'store' }}" method="POST">
        @csrf
        @if (isset($user))
            @method('PUT')
        @endif

        <div class="card-body">

            <div class="form-group row mb-4"">
                <label for="name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name <sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-12 col-md-7">
                    <input id="name" name="name" type="text" wire:model='name' class="form-control @error('name') is-invalid @enderror"
                        value="{{ isset($user) ? old('name', $user->name) : '' }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-4"">
                <label for="email" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email <sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-12 col-md-7">
                    <input id="email" name="email" type="text" wire:model='email' class="form-control @error('email') is-invalid @enderror"
                        value="{{ isset($user) ? old('email', $user->email) : '' }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-4"">
                <label for="phone" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone </label>
                <div class="col-sm-12 col-md-7">
                    <input id="phone" name="phone" type="text" wire:model='phone' class="form-control @error('phone') is-invalid @enderror"
                        value="{{ isset($user) ? old('phone', $user->phone) : '' }}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            @if (isset($user))
            <div class="form-group row mb-4"">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="role">Role <sup
                        class="text-danger">*</sup></label>
                <div class="col-sm-12 col-md-7">
                    <select name="role" id="role" wire:model='role' class="form-control @error('role') is-invalid @enderror">
                        <option value="ADM" {{ isset($user) && $user->role == 'ADM' ? 'selected' : '' }}>Admin
                        </option>
                        <option value="USR" {{ isset($user) && $user->role == 'USR' ? 'selected' : '' }}>User
                        </option>
                        <option value="WRT" {{ isset($user) && $user->role == 'WRT' ? 'selected' : '' }}>Writer
                        </option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            @endif


        </div>
        @isset($user)
        @include('admin.includes.button-2', ['title' => 'Update', 'method'=>'update', 'loadingState' => 'Updating...'])
        @else
        @include('admin.includes.button-2', ['title' => 'Save', 'method'=>'store', 'loadingState' => 'Saving...'])
        @endisset
    </form>
</div>
