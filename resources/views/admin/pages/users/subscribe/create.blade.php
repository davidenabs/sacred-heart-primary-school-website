@extends('admin.layouts.app')
@if (isset($subscribe))
@section('title', 'Edit subscriber')
@else
@section('title', 'Add subscriber')
@endif

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('admin.roles.index') }}">All Roles</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row mt-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Email subscribers</h4>
                            </div>
                            @if (isset($subscribe))
                                @livewire('admin.subscribe-component', [
                                    'subscribe' => $subscribe,
                                ])
                            @else
                                @livewire('admin.subscribe-component')
                            @endif
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
