@extends('admin.layouts.app')
@section('title', 'Staff: '. $management->name)

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4>Your Staff</h4>
                            </div>
                            <div class="card-body">
                                <div class="empty-state" data-height="400" style="height: 400px;">
                                    <img alt="{{ $management->name }}" src="{{ asset($management->avatar) }}"
                                        class="rounded-circle shadow" width="150" height="150" data-toggle="title"
                                        title="{{ $management->name . ' avatar' }}">
                                    <h2>Name: {{ $management->name }}</h2>
                                    <h6>Role: {{ $management->role }}</h6>
                                    <h6>Date added: {{ $management->created_at->format('M d, Y') }}</h6>
                                    <p class="lead">
                                        {{ $management->bio }}
                                    </p>
                                    <div>
                                        <div id="icons" class="ionicons mb-2">
                                        <a href="https://twitter.com/{{ $management->social_tw }}" target="_blank" class="ion-social-twitter " data-pack="social" data-tags="follow, post, share"></a>
                                        <a href="https://facebok.com/{{ $management->social_fb }}" target="_blank" class="ion-social-facebook mx-3" data-pack="social" data-tags="follow, post, share"></a>
                                        <a href="https://instagram.com/{{ $management->social_ig }}" target="_blank" class="ion-social-instagram " data-pack="social" data-tags="follow, post, share"></a>
                                        </div>
                                        <a href="{{ route('admin.managements.edit', $management->id) }}"
                                            class="my-2 bb">Edit</a>
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

@section('scripts')
    <script src="{{ asset('backend/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('backend/assets/js/page/index.js') }}"></script>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('backend/assets/bundles/ionicons/css/ionicons.min.css') }}">
@endsection
