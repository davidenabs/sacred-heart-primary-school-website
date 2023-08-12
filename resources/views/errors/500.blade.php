@extends(Auth::check() ? 'admin.layouts.error' : 'guest.layouts.error')
@section('title', '500')

@section('content')
    @if (Auth::check())
        @include('admin.includes.error-page', [
            'title' => '500',
            'messgae' => 'Whoopps, something went wrong.',
        ])
    @else
        @include('guest.includes.error-page', [
            'title' => '500 ERROR! ',
            'message' => "General Server Error!",
            'imageLink' => asset('frontends/assets/img/500.jpg')
        ])
    @endif
@endsection
