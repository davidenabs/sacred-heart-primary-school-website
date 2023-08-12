@extends('admin.layouts.app')
@section('title', 'School settings')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h4>School Info. Settings</h4>
                            </div>
                            <form action="{{ route('admin.settings.update', $setting) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="school_name">School name</label>
                                        <input id="school_name" name="school_name" type="text" class="form-control"
                                            value="{{ old('school_name', $setting->school_name) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="about_school">About school</label>
                                        <textarea class="form-control" id="about_school" name="about_school">{{ old('about_school', $setting->about_school) }} </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone_number">School phone number</label>
                                        <input type="number" class="form-control" id="phone_number"
                                            placeholder="0812345678" name="phone_number"
                                            value="{{ old('phone_number', $setting->phone_number) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="school_email">School email</label>
                                        <input type="email" class="form-control" id="school_email"
                                            placeholder="mail@school.com" name="school_email"
                                            value="{{ old('school_email', $setting->school_email) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="school_address">School address</label>
                                        <textarea class="form-control" id="school_address" name="school_address"> {{ old('school_address', $setting->school_address) }} </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="school_address">Social media handle</label>
                                        <div class="form-inline">
                                            <label class="sr-only" for="fb">Facebook</label>
                                            <input type="text" class="form-control mb-2 mr-sm-2" id="fb"
                                                placeholder="Facebook" name=" "
                                                value="{{ old('school_name', $setting->school_name) }}">
                                            <label class="sr-only" for="ig">Instagram</label>
                                            <input type="text" class="form-control  mb-2 mr-sm-2" id="ig"
                                                placeholder="Instagram" name=" "
                                                value="{{ old('school_name', $setting->school_name) }}">
                                            <label class="sr-only" for="tw">Twitter</label>
                                            <input type="text" class="form-control  mb-2 mr-sm-2" id="tw"
                                                placeholder="Instagram" name=" "
                                                value="{{ old('school_name', $setting->school_name) }}">
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1" type="submit">Save</button>
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
<!-- Page Specific JS File -->
<script src="{{ asset('backend/assets/js/page/index.js') }}"></script>
@endsection
