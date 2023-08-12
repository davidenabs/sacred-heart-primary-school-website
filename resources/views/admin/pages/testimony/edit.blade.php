@extends('admin.layouts.app')
@section('title', 'Edit Testimony')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h4>School testimonys</h4>
                            </div>
                            <form action="{{ route('admin.testimonies.update', $testimony) }}" method="POST">
                                @csrf
                                @if (isset($testimony))
                                    @method('PUT')
                                @endif

                                <div class="card-body">

                                    <div class="form-group row mb-4"">
                                        <label for="name"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                                value="{{ isset($testimony) ? old('name', $testimony->name) : '' }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4"">
                                        <label for="email"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                value="{{ isset($testimony) ? old('email', $testimony->email) : '' }}">

                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4"">
                                        <label for="occupation"
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">occupation <sup
                                                class="text-danger">*</sup></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input id="occupation" name="occupation" type="text" class="form-control @error('occupation') is-invalid @enderror"
                                                value="{{ isset($testimony) ? old('occupation', $testimony->occupation) : '' }}">
                                                @error('occupation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4"">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                            for="review">Review <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control @error('review') is-invalid @enderror" id="review" name="review">{{ isset($testimony) ? old('review', $testimony->review) : '' }} </textarea>
                                            @error('review')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4"">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                                            for="is_approve">Status <sup class="text-danger"></sup></label>
                                        <div class="col-sm-12 col-md-7">
                                            <select name="is_approve" id="is_approve" class="form-control @error('is_approve') is-invalid @enderror"
                                                value="{{ isset($testimony) ? old('is_approve', $testimony->is_approve) : '' }}">
                                                <option value="1"
                                                    {{ isset($testimony) && $testimony->is_approve == 1 ? 'selected' : '' }}>
                                                    Approve</option>
                                                <option value="0"
                                                    {{ isset($testimony) && $testimony->is_approve == 0 ? 'selected' : '' }}>
                                                    Not Approve</option>
                                            </select>
                                            @error('is_approve')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary mr-1"
                                        type="submit">{{ isset($testimony) ? 'Update' : 'Save' }}</button>
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