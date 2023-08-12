@extends('admin.layouts.app')
@section('title', 'User[' . $user->role . ']: ' . $user->name)

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $user->name }}'s Account Details</h4>
                            </div>
                            <div class="card-body">
                                @if ($user->trashed())
                                    <div class="alert alert-danger alert-with-icon shake fade out show" role="alert"
                                        style="transition: 0.5s;" data-notify="container" data-dismiss="aler"
                                        aria-label="close">
                                        <button type="button" aria-hidden="true" class="close" disabled>
                                            <i
                                                class="now-ui-icons ui-1_simple-remove bg-light rounded-circle small text-danger"></i>
                                        </button>
                                        <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
                                        <span data-notify="message">This account has been blocked</span>
                                    </div>
                                @endif

                                <div class="empty-state" data-height="400" style="height: 400px;">
                                    <img alt="{{ $user->name }}" src="{{ asset($user->avatar) }}"
                                        class="rounded-circle shadow" width="150" height="150" data-toggle="title"
                                        title="{{ $user->name . ' avatar' }}">
                                    <h2>Name: {{ $user->name }}</h2>
                                    <h6>Role: {{ $user->role }}</h6>
                                    <h6>Date added: {{ $user->created_at->format('M d, Y') }}</h6>
                                    <p class="lead">
                                        {{ $user->bio }}
                                    </p>
                                </div>
                                <div class="d-flex justify-content-center">
                                    @if ($user->trashed())
                                        <form action="{{ route('admin.users.forceDestroy', [$type, $user->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"><i class="fa fa-trash small"></i> Delete
                                                user</button>
                                        </form>
                                        <div class="mx-1"></div>
                                        <a href="{{ route('admin.users.restore', [$type, $user->id]) }}">
                                            <button class="btn btn-success"><i class="fa fa-refresh small"></i> Restore
                                                user</button>
                                        </a>
                                    @else
                                        <div class="mx-1"></div>
                                        <form action="{{ route('admin.users.blockUser', [$type, $user->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-warning"><i class="fa fa-warning small"></i> Block
                                                user</button>
                                        </form>
                                    @endif
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
