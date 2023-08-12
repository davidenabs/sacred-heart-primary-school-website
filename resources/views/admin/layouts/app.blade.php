<!DOCTYPE html>
<html lang="en">


<!-- Powered by Techmanna © 2023 techmannanng@gmail.com -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin | {{ Config::get('app.name', 'Sacred Heart Primary School') }}</title>
    <link href="{{ asset('shs/logo/sacred-heart-primary-school-kaduna.webp') }}" rel='shortcut icon' type='image/x-icon' >
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/izitoast/css/iziToast.min.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">
    @livewireStyles
</head>

<body>
    {{-- <div class="loader"></div> --}}
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('admin.includes.navbar')
            @include('admin.includes.sidebar')

            <!-- Main Content -->

            @yield('content')

            <footer class="main-footer">
                <div class="footer-left">
                    <a href="codeAfrika.com.ng">Powered by CodeArika</a></a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('backend/assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('backend/assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
    @if(Session::has('success'))
        <script>
            iziToast.success({position: 'topRight', message: "{{ Session::get('success') }}"})
        </script>
    @endif

    @if(Session::has('error'))
        <script>
            iziToast.error({position: 'topRight', message: "{{ Session::get('error') }}"})
        </script>
    @endif

    @if(Session::has('info'))
        <script>
            iziToast.info({position: 'topRight', message: "{{ Session::get('info') }}"})
        </script>
    @endif

    @if(Session::has('warning'))
        <script>
            iziToast.warning({position: 'topRight', message: "{{ Session::get('warning') }}"})
        </script>
    @endif
    @livewireScripts
</body>


</html>
