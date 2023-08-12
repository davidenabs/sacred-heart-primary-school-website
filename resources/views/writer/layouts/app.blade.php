<!DOCTYPE html>
<html lang="en">


<!-- Powered by CodeAfrika © 2023 davidenabs@gmail.com -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ Config::get('app.name', 'app.creator') }}</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/izitoast/css/iziToast.min.css') }}">
    @yield('styles')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('backend/assets/img/favicon.ico') }}' />

    @livewireStyles
</head>

<body>
    {{-- <div class="loader"></div> --}}
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('writer.includes.navbar')
            @include('writer.includes.sidebar')

            <!-- Main Content -->

            @yield('content')

            <footer class="main-footer">
                <div class="footer-left">
                    Powered by <a href="{{ env('CREATOR_URL') }}">{{ env('CREATOR_NAME') }}</a></a>
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
{{-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores perferendis nesciunt corporis sapiente voluptatibus sed obcaecati dolorum, earum autem nisi optio rem non! Earum fugit aperiam labore iusto rem adipisci eaque, consequuntur possimus itaque, sed nisi explicabo quasi! Distinctio necessitatibus deleniti perspiciatis quasi commodi consectetur ex facilis labore harum molestias ipsam possimus suscipit quia quibusdam architecto qui, ullam ducimus reiciendis quas eligendi ad perferendis deserunt maxime in. Distinctio, qui praesentium. --}}