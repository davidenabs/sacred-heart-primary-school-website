@extends(Auth::check() ? 'admin.layouts.error' : 'guest.layouts.error')
@section('title', '400')

@section('content')
    @if (Auth::check())
        @include('admin.includes.error-page', [
            'title' => '400',
            'messgae' => "Bad request (somethimg wrong with
                URL or parameter).",
        ])
    @else
        @include('guest.includes.error-page', [
            'title' => '400 ERROR! ',
            'message' => "Bad request (somethimg wrong with
                URL or parameter).",
            'imageLink' => asset('frontends/assets/img/errors/400.jpeg')
        ])
    @endif
@endsection
