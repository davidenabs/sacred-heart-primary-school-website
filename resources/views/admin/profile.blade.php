@extends('admin.layouts.app')
@section('title')
    Profile
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-4">
                        <div class="card author-box">
                            <div class="card-body">
                                <div class="author-box-center">
                                    <img alt="image"
                                        src="{{ $user->writerInfo->profile ? asset($user->writerInfo->profile) : asset('frontend/assets/img/profile.jpg') }}"
                                        class="rounded-circle author-box-picture">
                                    <div class="clearfix"></div>
                                    <div class="author-box-name">
                                        <a href="#">{{ $user->name }}</a>
                                    </div>
                                    <div class="author-box-job">
                                        @if ($user->role == 'WRT')
                                            Writer
                                        @elseif($user->role == 'ADM')
                                            Admin
                                        @else
                                            Unkown
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="author-box-description">
                                        <p>
                                            {{ $user->bio }}
                                        </p>
                                    </div>
                                    {{-- <div class="mb-2 mt-3">
                                        <div class="text-small font-weight-bold">Social media</div>
                                    </div>
                                    <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-social-icon mr-1 btn-github">
                                        <i class="fab fa-github"></i>
                                    </a>
                                    <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <div class="w-100 d-sm-none"></div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Personal Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="py-4">
                                    {{-- <p class="clearfix">
                                        <span class="float-left">
                                            Birthday
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ $user->writerInfo->birthday }}
                                        </span>
                                    </p> --}}
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Phone
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ $user->phone }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Mail
                                        </span>
                                        <span class="float-right text-muted">
                                            {{ $user->email }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Facebook
                                        </span>
                                        <span class="float-right text-muted">
                                            <a target="_blank"
                                                href="https://facebook.com/{{ $user->writerInfo->facebook }}">{{ $user->writerInfo->facebook }}</a>
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left">
                                            Twitter
                                        </span>
                                        <span class="float-right text-muted">
                                            <a target="_blank"
                                                href="https://twitter.com/{{ $user->writerInfo->twitter }}">{{ '@' . $user->writerInfo->twitter }}</a>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-8">
                        <div class="card">
                            <div class="padding-20">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('tab') === null ? 'active' : '' }}" id="home-tab2" data-toggle="tab" href="#about"
                                            role="tab" aria-selected="true">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('tab') === 'settings' ? 'active' : '' }}" id="profile-tab2" data-toggle="tab" href="#settings"
                                            role="tab" aria-selected="false">Setting</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('tab') === 'security' ? 'active' : '' }}" id="security-tab2" data-toggle="tab" href="#security"
                                            role="tab" aria-selected="false">Security</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-bordered" id="myTab3Content">
                                    <div class="tab-pane fade {{ request()->query('tab') === null ? 'show active' : '' }}" id="about" role="tabpanel"
                                        aria-labelledby="home-tab2">
                                        <div class="row">
                                            <div class="col-md-3 col-6 b-r">
                                                <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted">{{ $user->name }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r">
                                                <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted">{{ $user->phone }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 b-r">
                                                <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                        <p class="m-t-30">
                                            {{ $user->writerInfo->bio }}
                                        </p>
                                    </div>
                                    <div class="tab-pane fade {{ request()->query('tab') === 'settings' ? 'show active' : '' }}" id="settings" role="tabpanel"
                                        aria-labelledby="profile-tab2">
                                        <form method="post" action="{{ route('admin.profile.update') }}"
                                            class="needs-validation" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="card-header">
                                                <h4>Edit Profile</h4>
                                            </div>
                                            <input type="hidden" name="tab" value="settings">
                                            <div class="card-body">
                                                @php
                                                    $fullName = $user->name; // Assuming the full name is stored in 'name' field

                                                    // Split the full name into an array of first name and last name
                                                    $nameParts = explode(' ', $fullName);

                                                    $firstName = $nameParts[0]; // The first part is the first name
                                                    $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
                                                @endphp
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>First Name</label>
                                                        <input type="text" class=" @error('first_name') is-invalid @enderror form-control" name="first_name"
                                                            value="{{ $firstName }}"
                                                            @if(Auth::id() == '1') disabled @endif>
                                                        @error('first_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Last Name</label>
                                                        <input type="text" class=" @error('last_name') is-invalid @enderror form-control" name="last_name"
                                                            value="{{ $lastName }}"
                                                            @if(Auth::id() == '1') disabled @endif>
                                                        @error('last_name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-7 col-12">
                                                        <label>Email</label>
                                                        <input type="email" class=" @error('email') is-invalid @enderror form-control" name="email"
                                                            value="{{ $user->email }}"
                                                            @if(Auth::id() == '1') disabled @endif>
                                                        @error('email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-5 col-12">
                                                        <label>Phone</label>
                                                        <input type="tel" class=" @error('phone') is-invalid @enderror form-control" name="phone"
                                                            value="{{ $user->phone }}">
                                                        @error('phone')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <label>Bio</label>
                                                        <textarea name="bio" class=" @error('bio') is-invalid @enderror form-control summernote-simple">{{ $user->writerInfo->bio }}</textarea>
                                                        @error('bio')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <label>Profile photo</label><br>
                                                        <input type="file" name="profile" class="form-control @error('profile') is-invalid @enderror" id="">
                                                        @error('profile')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Facbook</label>
                                                        <input type="text" class=" @error('facebook') is-invalid @enderror form-control" name="facebook"
                                                            value="{{ $user->writerInfo->facebook }}">
                                                        @error('facebook')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Twitter</label>
                                                        <input type="text" class=" @error('twitter') is-invalid @enderror form-control" name="twitter"
                                                            value="{{ $user->writerInfo->twitter }}">
                                                        @error('twitter')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade {{ request()->query('tab') === 'security' ? 'show active' : '' }}" id="security" role="tabpanel"
                                        aria-labelledby="security-tab2">
                                        <form method="post" action="{{ route('admin.profile.update.password') }}"
                                            class="needs-validation" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="tab" value="security">
                                            <div class="card-header">
                                                <h4>Change password</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="form-group col-12">
                                                        <label>Current password</label>
                                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password"
                                                            placeholder="********">
                                                        @error('current_password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>New password</label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                                            placeholder="{{ '********' }}">
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6 col-12">
                                                        <label>Comfirm password</label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                            name="password_confirmation" placeholder="{{ '********' }}">
                                                        @error('password_confirmation')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
