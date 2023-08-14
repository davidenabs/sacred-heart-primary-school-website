@extends(Auth::check() ? 'admin.layouts.error' : 'guest.layouts.error')
@section('title', '404')

@section('content')
    @if (Auth::check())
        @include('admin.includes.error-page', [
            'title' => '404',
            'messgae' => 'The page you were looking for could not be found.',
        ])
    @else
        @include('guest.includes.error-page', [
            'title' => '404 ERROR! ',
            'message' => "The page you are trying to access doesn't exist or has been moved.",
            'imageLink' => asset('frontend/assets/img/errors/404.jpeg')
        ])
    @endif
@endsection
