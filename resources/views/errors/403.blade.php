@extends(Auth::check() ? 'admin.layouts.error' : 'guest.layouts.error')
@section('title', '403')

@section('content')
    @if (Auth::check())
        @include('admin.includes.error-page', [
            'title' => '403',
            'messgae' => 'You are not authorized to access this route.',
        ])
    @else
        @include('guest.includes.error-page', [
            'title' => '403 ERROR! ',
            'message' =>
                'The page you are trying to access is not authorized or (not logged in) <br> Try going back to the Homepage',
            'imageLink' => asset('frontends/assets/img/403.jpg'),
        ])
    @endif
@endsection
