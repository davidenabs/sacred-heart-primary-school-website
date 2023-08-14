@extends(Auth::check() ? 'admin.layouts.error' : 'guest.layouts.error')
@section('title', '401')

@section('content')
    @if (Auth::check())
        @include('admin.includes.error-page', [
            'title' => '401',
            'messgae' => 'You are not authorized to access this route.',
        ])
    @else
        @include('guest.includes.error-page', [
            'title' => '401 ERROR! ',
            'message' =>
                'The page you are trying to access is not authorized or (not logged in) <br> Try going back to the Homepage',
            'imageLink' => asset('frontend/assets/img/errors/401.jpeg'),
        ])
    @endif
@endsection
