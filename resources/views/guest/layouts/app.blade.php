<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Sacred Heart Primary School')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield('meta_keyboard', 'Sacred Heart, Primary School, Independence way Kaduna')" name="keywords">
    <meta content="@yield('meta_description', 'Sacred Heart Primary School')" name="description">
    @yield('other_meta_tags')
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('shs/logo/sacred-heart-primary-school-kaduna.webp') }}" rel='shortcut icon'
        type='image/x-icon'>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="{{ asset('frontend/assets/lib/flaticon/font/flaticon.css') }}" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">

    <!-- Animate Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}" />

    <!-- Image Grid Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/grid_image.css') }}" />
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">

    <style>
        .position-relative {
            position: relative;
        }

        .image-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .moving-image {
            transition: transform 0.9s ease;
            opacity: 0.2;
        }
    </style>

    @yield('styles')

    @livewireStyles

</head>

<body class="bglight">
    <!-- Navbar Start -->
    @include('guest.includes.navbar')
    <!-- Navbar End -->
    <!-- Header Start -->
    @yield('content')

    <!--Footer start-->
    @include('guest.includes.footer')
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn p-3 back-to-top" style="background-color: rgb(31, 30, 112); color: white;"><i
            class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/lib/lightbox/js/lightbox.min.js') }}"></script>
    <!--  Javascript -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <!-- Image Slide -->
    <script src="{{ asset('frontend/assets/js/img_scroll.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <script>
        function moveImage(event) {
            const container = document.querySelector('.image-container');

            const containerRect = container.getBoundingClientRect();

            const mouseX = event.clientX - containerRect.left;

            const mouseY = event.clientY - containerRect.top;

            const centerX = containerRect.width / 2;

            const centerY = containerRect.height / 2;

            const distanceX = mouseX - centerX;

            const distanceY = mouseY - centerY;

            let images = document.querySelectorAll(".moving-image");

            images[0].style.transform = "translate(" + (distanceX * 0.1) + "px, " + (distanceY * 0.1) + "px)";
            images[1].style.transform = "translate(" + (distanceX * 0.2) + "px, " + (distanceY * 0.1) + "px)";
            images[2].style.transform = "translate(" + (distanceX * 0.1) + "px, " + (distanceY * 0.3) + "px)";

            images[3].style.transform = "translate(" + (distanceX * 0.1) + "px, " + (distanceY * 0.1) + "px)";
            images[4].style.transform = "translate(" + (distanceX * 0.05) + "px, " + (distanceY * 1.1) + "px)";
            images[5].style.transform = "translate(" + (distanceX * 0.1) + "px, " + (distanceY * 0.1) + "px)";
            images[6].style.transform = "translate(" + (distanceX * 0.1) + "px, " + (-distanceY * 0.5) + "px)";

        }
    </script>
    @yield('scripts')

    @livewireScripts
</body>

</html>