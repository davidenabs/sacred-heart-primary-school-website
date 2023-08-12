@extends('admin.layouts.app')
@section('title', 'Manage Management')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h4>School Managements</h4>
                            </div>
                            <form action="{{ isset($management) ? route('admin.managements.update', $management) : route('admin.managements.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if (isset($management))
                                @method('PUT')
                                @endif

                                <div class="card-body">

                                    <div class="form-group row mb-4"">
                                        <label for="name" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name of staff <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-12 col-md-7">
                                        <input id="name" name="name" type="text" class="form-control"
                                            value="{{ isset($management) ? old('name', $management->name) : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4"">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="bio">Breif bio about staff <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control" id="bio" name="bio">{{ isset($management) ? old('bio', $management->bio) : '' }} </textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4"">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="role">Staff's role <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-12 col-md-7">
                                        <select name="role" id="role" class="form-control" value="{{ isset($management) ? old('role', $management->role) :'' }}">
                                        <option value="Teacher"
                                        {{ (isset($management) && $management->role == 'Teacher') ? 'selected' : ''}}>Teacher</option>
                                        <option value="Head Teacher"
                                        {{ (isset($management) && $management->role == 'Head Teacher') ? 'selected' : ''}}>Head Teacher</option>
                                        <option value="Head Teacher"
                                        {{ (isset($management) && $management->role == 'Head of Department') ? 'selected' : ''}}>Head of Department</option>
                                        <option value="Head Teacher"
                                        {{ (isset($management) && $management->role == 'Principal') ? 'selected' : ''}}>Principal</option>
                                        <option value="Head Teacher"
                                        {{ (isset($management) && $management->role == 'Secretary') ? 'selected' : ''}}>Secretary</option>
                                    </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4"">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="school_address">Social media handle</label>
                                        <div class="col-sm-12 col-md-7">
                                        <div class="form-inline">
                                            <label class="sr-only" for="fb">Facebook</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" id="fb"
                                                placeholder="Facebook" name="social_fb"
                                                value="{{ isset($management) ? old('social_fb', $management->social_fb) : ''}}">
                                            <label class="sr-only" for="ig">Instagram</label>
                                            <input type="text" class="form-control  mb-2 mr-sm-2" id="ig"
                                                placeholder="Instagram" name="social_ig"
                                                value="{{ isset($management) ? old('social_ig', $management->social_ig) : ''}}">
                                            <label class="sr-only" for="tw">Twitter</label>
                                            <input type="text" class="form-control  mb-2 mr-sm-2" id="tw"
                                                placeholder="Twitter" name="social_tw"
                                                value="{{ isset($management) ? old('social_tw', $management->social_tw) : ''}}">
                                        </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Avatar</label>
                                        @isset($management)
                                        <div class="col-sm-12 col-md-4">
                                          <div id="image-previe" class="image-preview">
                                            <img src="{{ asset($management->avatar) }}" class="img-fluid" alt="" srcset="">
                                          </div>
                                        </div>
                                        @endisset
                                        <div class="col-sm-12 col-md-4">
                                            <div id="image-preview" class="image-preview">
                                              <label for="image-upload" id="image-label">Choose File</label>
                                              <input type="file" name="image" id="image-upload" />
                                            </div>
                                          </div>
                                      </div>


                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">{{ isset($management) ? 'Update' : 'Save' }}</button>
                                    <button class="btn btn-secondary" type="reset">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('backend/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('backend/assets/js/page/index.js') }}"></script>
<script src="{{ asset('backend/assets/js/page/create-post.js') }}"></script>
@endsection
