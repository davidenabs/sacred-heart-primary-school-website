@extends('guest.layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
@endsection

@section('content')
    <div class="container-fluid position-relative px-0 px-md-5 mb-5 bg-blue d-none d-lg-block" onmousemove="moveImage(event)">
        <div class="image-container">
            <div class="d-flex justify-content-around">
                <div>
                    <div>
                        {{-- <img src="{{ asset('shs_images/circles/1.webp') }}" alt=" " class="moving-image" --}}
                        {{-- style="width: 20px;"> --}}
                        {{-- <img src="{{ asset('shs_images/circles/3.webp') }}" alt=" " class="moving-image" style="width: 20px; "> --}}
                        <img src="{{ asset('shs_images/circles/4.webp') }}" alt=" " class="moving-image d-block"
                            style="width: 20px;">
                    </div>

                    <div class=" align-item-center">
                        <img src="{{ asset('shs_images/circles/3.webp') }}" alt=" " class="moving-image"
                            style="width: 200px;">
                        <img src="{{ asset('shs_images/circles/4.webp') }}" alt=" " class="moving-image"
                            style="width: 90px;">
                    </div>
                </div>
                <div>
                    <img src="{{ asset('shs_images/circles/1.webp') }}" alt=" " class="moving-image"
                        style="width: 100px;">
                </div>

                <div class="float-righ">
                    <img src="{{ asset('shs_images/circles/2.webp') }}" alt=" " class="moving-image"
                        style="width: 400px;">
                    <img src="{{ asset('shs_images/circles/1.webp') }}" alt=" " class="moving-image"
                        style="width: 100px;">
                </div>
            </div>
        </div>

        <div class="row align-items-center px-3">
            <div class="col-lg-6 text-center text-sm-left">
                <i class="text-white mb-4 mt-5 mt-sm-0"></i>
                <div class="display-4 font-weight-bold text-white text-left animate__animated animate__backInLeft"
                    id="headerText" style="font-weight: 700;">Sacred Heart <br>
                    Primary School</div>
                <p class="text-white mb-4 text-left animate__animated animate__backInRight">Our vision is to build a
                    community where all <br>children feel loved,
                    <br>respected and encouraged to develop to their fullest potentials. <br>
                </p>
                <a href="{{ route('about') }}" class="btn mt-1 py-3 px-5 animate__animated animate__bounce btn-outline-light">Learn More</a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-right text-light"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                </svg>
            </div>
            <div class="col-lg-6 text-center text-lg-right img-hol w-100">
                <div id="imageCarousel" class="carouselslide" data-ride="carouselx">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="hero-img mt-5 d-none d-lg-block" src="{{ asset('frontend/assets/img/img4.jpg') }}"
                                alt="">
                        </div>
                        {{-- <!-- Add more carousel items as needed -->
                        <div class="carousel-item">
                            <img class="hero-img mt-5 d-none d-lg-block" src="{{ asset('frontend/assets/img/img10.jpg') }}"
                                alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="hero-img mt-5 d-none d-lg-block" src="{{ asset('frontend/assets/img/img8.jpg') }}"
                                alt="">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- mobile --}}
    <div class="container-fluid position-relative px-0 px-md-5 mb-5 d-lg-none">

        <div class="d-fle align-content-center">
            <section id="hero" class="static-text">
                <div>
                    <div class="display-4 text-white font-weight-bold animate__animated animate__backInLeft">
                        Sacred Heart<br>Primary School
                      </div>
                      <p class="text-white mb-4 text-center animate__animated animate__backInRight">Our vision is to build a
                        community where all <br>children feel loved,
                        <br>respected and encouraged to develop to their fullest potentials. <br>
                    </p>

                      <a href="{{ route('about') }}" class="btn btn-whit mb-5 btn-outline-light animate__animated animate__bounce">Learn More</a>
                </div>
              </section>
        </div>

        <!-- Carousel section with image transition -->
        <div id="carouselExampleFade" class="carousel slide carousel-fade pointer-event" data-ride="carousel" style="">
            <div class="carousel-inner">
                <div class="carousel-item">
                    <img class="img-fluid zoom-in img-fixed-size d-block w-100"
                        src="{{ asset('frontend/assets/img/img6.jpg') }}" alt="First slide">
                    <div class="carousel-overlay"></div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid zoom-in img-fixed-size d-block w-100"
                        src="{{ asset('frontend/assets/img/img8.jpg') }}" alt="Second slide">
                    <div class="carousel-overlay"></div>
                </div>
                <div class="carousel-item active">
                    <img class="img-fluid zoom-in img-fixed-size d-block w-100"
                        src="{{ asset('frontend/assets/img/img10.jpg') }}" alt="Third slide">
                    <div class="carousel-overlay"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Pop Welcome MEssage -->
    {{-- @include('guest.includes.home.welcome-message') --}}
    <!-- end Pop Welcome MEssage -->
    <!-- Gallery -->
    @include('guest.includes.home.gallery')
    <!-- end Gallery -->
    <!-- Our activities -->
    @include('guest.includes.home.our-activities')
    <!-- end our activities -->
    <!-- About Start -->
    @include('guest.includes.home.about')
    <!-- About End -->
    <!-- Class Start -->
    @include('guest.includes.home.classes')
    <!-- Class End -->
    <!-- Team Start -->
    @include('guest.includes.home.team')
    <!-- Team End -->
    <!-- Testimonial Start -->
    @include('guest.includes.home.testimonial')
    <!-- Testimonial End -->
    <!-- Blog Start -->
    @include('guest.includes.home.blog')
    <!-- Blog End -->
@endsection


@section('scripts')
    <script>
        baguetteBox.run(".gallery", {
            animation: "slideIn"
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function() {

                $(this).addClass('transition');
            }, function() {

                $(this).removeClass('transition');
            });
        });
    </script>
@endsection
