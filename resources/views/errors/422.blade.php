@extends(Auth::check() ? 'admin.layouts.error' : 'guest.layouts.error')
@section('title', '422')

@section('content')
    @if (Auth::check())
        @include('admin.includes.error-page', [
            'title' => '422',
            'messgae' => "Unprocessable Entity! <br> ( validation
                failed).",
        ])
    @else
        @include('guest.includes.error-page', [
            'title' => '422 ERROR! ',
            'message' => "Unprocessable Entity! <br> ( validation
                failed).",
            'imageLink' => asset('frontend/assets/img/errors/422.jpeg')
        ])
    @endif
@endsection
