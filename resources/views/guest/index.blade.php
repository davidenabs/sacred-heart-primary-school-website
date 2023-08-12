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
                <a href="{{ route('about') }}" class="btn mt-1 py-3 px-5 font-weight-bold animate__animated animate__bounce"
                    style="color: rgb(31, 30, 112); background-color: white;">Learn More</a>
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
                        <!-- Add more carousel items as needed -->
                        <div class="carousel-item">
                            <img class="hero-img mt-5 d-none d-lg-block" src="{{ asset('frontend/assets/img/img10.jpg') }}"
                                alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="hero-img mt-5 d-none d-lg-block" src="{{ asset('frontend/assets/img/img8.jpg') }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section for Mobile and Tablet View (with carousel and dark overlay) -->
    <!-- Text that appears once when the page loads -->

    <div class="container-fluid px-0 px-md-5 mb-5 d-lg-none">
        <!-- Static text on top of the carousel -->
        <div class="static-text text-white ">
            <div class="display-4 text-white font-weight-bold animate__animated animate__backInLeft">Sacred Heart
                Primary School</div>
            <p class="animate__animated animate__backInRight">Our vision is to build a community where all children feel
                loved, respected, and encouraged to develop to their fullest potentials.</p>
            <a href="{{ route('about') }}" class="btn btn-sm btn-round mb-4 py-2 px-1 font-weight-bold"
                style="color: rgb(31, 30, 112); background-color: white;">Learn More</a>
        </div>

        <!-- Carousel section with image transition -->
        <div id="carouselExampleFade" class="carousel slide carousel-fade pointer-event" data-ride="carousel">
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
            {{-- <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a> --}}
        </div>
        {{-- <div id="imageCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid zoom-in img-fixed-size" src="{{ asset('frontend/assets/img/img6.jpg') }}" alt="Monk">
                <div class="carousel-overlay"></div> <!-- Add dark overlay -->
            </div>
            <div class="carousel-item">
                <img class="img-fluid zoom-in img-fixed-size" src="{{ asset('frontend/assets/img/img8.jpg') }}" alt="Boys">
                <div class="carousel-overlay"></div> <!-- Add dark overlay -->
            </div>
            <div class="carousel-item">
                <img class="img-fluid zoom-in img-fixed-size" src="{{ asset('frontend/assets/img/img10.jpg') }}" alt="Buddhist">
                <div class="carousel-overlay"></div> <!-- Add dark overlay -->
            </div>
        </div>
        <!-- Add carousel controls if needed -->
    </div> --}}

    </div>


    <!-- Pop Welcome MEssage -->
    <div id="popup-container">
        <div id="popup-message">
            <img src="{{ asset('shs/logo/sacred-heart-primary-school-kaduna.webp') }}" width="100" alt="">
            <h2>Welcome to Sacred Heart <br> Primary School<br> Kaduna</h2>
            <p><i>...learning Never Ends</i></p>
        </div>
    </div>

    <!-- Header End -->

    <!-- Gallery -->
    <div class="container">
        <div class="text-center pb-2">
            <p class="section-title px-5"><span class="px-2">Our school</span></p>
            <h1 class="mb-4">The best learning experience</h1>
        </div>

        <div class="container page-top">



            <div class="row">


                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a href="img/img3.jpg') }}" class="fancybox" rel="ligthbox">
                        <img src="{{ asset('frontend/assets/img/img3.jpg') }}" class="zoom img-fluid reveal fade-left"
                            alt="">

                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a href="img/img6.jpg') }}" class="fancybox" rel="ligthbox">
                        <img src="{{ asset('frontend/assets/img/img6.jpg') }}" class="zoom img-fluid reveal"
                            alt="">
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a href="img/img10.jpg') }}" class="fancybox" rel="ligthbox">
                        <img src="{{ asset('frontend/assets/img/img10.jpg') }}" class="zoom img-fluid reveal fade-top "
                            alt="">
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-xs-6 thumb d-md-block d-m-none">
                    <a href="img/img4.jpg') }}" class="fancybox" rel="ligthbox">
                        <img src="{{ asset('frontend/assets/img/img4.jpg') }}" class="zoom img-fluid reveal fade-right "
                            alt="">
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-xs-6 thumb d-md-block d-m-none">
                    <a href="img/img10.jpg') }}" class="fancybox" rel="ligthbox">
                        <img src="{{ asset('frontend/assets/img/img10.jpg') }}" class="zoom img-fluid reveal fade-left "
                            alt="">
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-xs-6 thumb d-md-block d-m-none">
                    <a href="img/img6.jpg') }}" class="fancybox" rel="ligthbox">
                        <img src="{{ asset('frontend/assets/img/img6.jpg') }}" class="zoom img-fluid reveal fade-bottom "
                            alt="">
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-xs-6 thumb d-md-block d-m-none">
                    <a href="img/img3.jpg') }}" class="fancybox" rel="ligthbox">
                        <img src="{{ asset('frontend/assets/img/img3.jpg') }}" class="zoom img-fluid reveal fade-top "
                            alt="">
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-xs-6 thumb d-md-block d-sm-none">
                    <a href="img/img8.jpg') }}" class="fancybox" rel="ligthbox">
                        <img src="{{ asset('frontend/assets/img/img8.jpg') }}" class="zoom img-fluid reveal fade-right "
                            alt="">
                    </a>
                </div>




            </div>




        </div>




    </div>

    <!-- Our activities -->
    <div class="py-3 light-g-blue">
        <div class="container gallery-container reveal fade-bottom">

            <div class="text-center pb-2 gx-1">
                <p class="section-title px-5"><span class="px-2">Our Activities</span></p>
                <h1 class="mb-4">The School Activities</h1>
            </div>

            <div class="ca-activities">

                <div class="row">

                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="thumbnail">
                            <div class="svg-container">
                                <div class="svg-info shs-bg-primary-color" style="width: 75px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square w-50 h-50 text-light"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 0C3.584 0 0 3.584 0 8s3.584 8 8 8c4.408 0 8-3.584 8-8s-3.592-8-8-8zm5.284 3.688a6.802 6.802 0 0 1 1.545 4.251c-.226-.043-2.482-.503-4.755-.217-.052-.112-.096-.234-.148-.355-.139-.33-.295-.668-.451-.99 2.516-1.023 3.662-2.498 3.81-2.69zM8 1.18c1.735 0 3.323.65 4.53 1.718-.122.174-1.155 1.553-3.584 2.464-1.12-2.056-2.36-3.74-2.551-4A6.95 6.95 0 0 1 8 1.18zm-2.907.642A43.123 43.123 0 0 1 7.627 5.77c-3.193.85-6.013.833-6.317.833a6.865 6.865 0 0 1 3.783-4.78zM1.163 8.01V7.8c.295.01 3.61.053 7.02-.971.199.381.381.772.555 1.162l-.27.078c-3.522 1.137-5.396 4.243-5.553 4.504a6.817 6.817 0 0 1-1.752-4.564zM8 14.837a6.785 6.785 0 0 1-4.19-1.44c.12-.252 1.509-2.924 5.361-4.269.018-.009.026-.009.044-.017a28.246 28.246 0 0 1 1.457 5.18A6.722 6.722 0 0 1 8 14.837zm3.81-1.171c-.07-.417-.435-2.412-1.328-4.868 2.143-.338 4.017.217 4.251.295a6.774 6.774 0 0 1-2.924 4.573z" />
                                    </svg>
                                </div>
                            </div>
                            <br>

                            <div class="caption m">
                                <h3>Sports</h3>
                                <p>
                                    Pupils are given the opportuinity to nurture,
                                    utilize and improve on their talents in the aspect of sport.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="svg-container">
                                <div class="svg-info shs-bg-primary-color" style="width: 75px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square w-50 h-50 text-light"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M6 13c0 1.105-1.12 2-2.5 2S1 14.105 1 13c0-1.104 1.12-2 2.5-2s2.5.896 2.5 2zm9-2c0 1.105-1.12 2-2.5 2s-2.5-.895-2.5-2 1.12-2 2.5-2 2.5.895 2.5 2z" />
                                        <path fill-rule="evenodd" d="M14 11V2h1v9h-1zM6 3v10H5V3h1z" />
                                        <path d="M5 2.905a1 1 0 0 1 .9-.995l8-.8a1 1 0 0 1 1.1.995V3L5 4V2.905z" />
                                    </svg>
                                </div>
                            </div>
                            <br>

                            <div class="caption">
                                <h3>Music</h3>
                                <p>Pupils are given the opportuinity to nurture,
                                    utilize and improve on their talents in the aspect of music.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="svg-container">
                                <div class="svg-info shs-bg-primary-color" style="width: 75px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square w-50 h-50 text-light"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.118 8.118 0 0 1-3.078.132 3.659 3.659 0 0 1-.562-.135 1.382 1.382 0 0 1-.466-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.394-.197.625-.453.867-.826.095-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.201-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.176-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04z" />
                                    </svg>
                                </div>
                            </div>
                            <br>

                            <div class="caption">
                                <h3>Art Club, Pottery</h3>
                                <p>Pupils are given the opportuinity to nurture,
                                    utilize and improve on their talents in the aspect of art.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="svg-container">
                                <div class="svg-info shs-bg-primary-color" style="width: 75px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square w-50 h-50 text-light"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5c0 .501-.164.396-.415.235C6.42 6.629 6.218 6.5 6 6.5c-.218 0-.42.13-.585.235C5.164 6.896 5 7 5 6.5 5 5.672 5.448 5 6 5s1 .672 1 1.5zm5.331 3a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5zm-1.746-2.765C10.42 6.629 10.218 6.5 10 6.5c-.218 0-.42.13-.585.235C9.164 6.896 9 7 9 6.5c0-.828.448-1.5 1-1.5s1 .672 1 1.5c0 .501-.164.396-.415.235z" />
                                    </svg>
                                </div>
                            </div>
                            <br>

                            <div class="caption">
                                <h3>Drama Club</h3>
                                <p>Pupils are given the opportuinity to nurture,
                                    utilize and improve on their talents in the aspect of acting.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="svg-container">
                                <div class="svg-info shs-bg-primary-color" style="width: 75px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square w-50 h-50 text-light"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M1 2a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-2H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 9H1V8H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6H1V5H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 2H1Zm11 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7Zm2 0a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM3.5 10a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6Zm0 2a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1h-6ZM4 4h-.5a.5.5 0 0 0 0 1H4v1h-.5a.5.5 0 0 0 0 1H4a1 1 0 0 0 1 1v.5a.5.5 0 0 0 1 0V8h1v.5a.5.5 0 0 0 1 0V8a1 1 0 0 0 1-1h.5a.5.5 0 0 0 0-1H9V5h.5a.5.5 0 0 0 0-1H9a1 1 0 0 0-1-1v-.5a.5.5 0 0 0-1 0V3H6v-.5a.5.5 0 0 0-1 0V3a1 1 0 0 0-1 1Zm7 7.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 0-.5.5Z" />
                                    </svg>
                                </div>
                            </div>
                            <br>

                            <div class="caption">
                                <h3>TIct, Judo</h3>
                                <p>Pupils are given the opportuinity to nurture,
                                    utilize and improve on their talents in the aspect of tech related.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="svg-container">
                                <div class="svg-info shs-bg-primary-color" style="width: 75px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil-square w-50 h-50 text-light"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </div>
                            </div>
                            <br>

                            <div class="caption">
                                <h3>Writers Club</h3>
                                <p>Pupils are given the opportuinity to nurture,
                                    utilize and improve on their talents in the aspect of writing.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- end our activities -->

    <!-- About Start -->
    <div class="container py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="d-none d-md-block rounded mb-5 mb-lg-0 reveal fade-left"
                        src="{{ asset('shs/logo/sacred-heart-primary-school-kaduna.webp') }}" alt=""
                        style="height: 300px; width: 300px;">
                </div>
                <div class="col-lg-7">
                    <p class="section-title pr-5"><span class="pr-2">Know more About Us</span></p>
                    <div>
                        <h2 class="mb-4">Best School For Your Kids</h2>
                    </div>
                    <p>Our Vission for every child is to build a community where all children feel lved,
                        respected and encouraged to develop to their fullest potentials.
                    </p>
                    <div class="row pt-2 pb-4">

                        <div class="col-12 col-md-8">
                            <ul class="list-inline m-0">
                                <li class="py-2 border-top border-bottom"><i class="fa fa-check mr-3"
                                        style=" color: rgb(31, 30, 112);"></i>Where Learning is Fun</li>
                                <li class="py-2 border-bottom"><i class="fa fa-check mr-3"
                                        style=" color: rgb(31, 30, 112);"></i>Great and intellectual Minds are made</li>
                                <li class="py-2 border-bottom"><i class="fa fa-check mr-3"
                                        style=" color: rgb(31, 30, 112);"></i>Ideas are derived.</li>
                            </ul>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="btn mt-2 py-2 px-4 shs-bg-primary-color text-white">Learn
                        More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Class Start -->
    <div class="py-3" style="background-color: #FAF4EA">
        <div class="container">
            <div class="">
                <div class="text-center pb-2">
                    <p class="section-title px-5"><span class="px-2">Popular Classes</span></p>
                    <h1 class="mb-4">Classes for Your Kids</h1>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-5">
                        <div class="border-0 bg-light shadow-sm pb-2">
                            <img class="card-img-top mb-2" src="{{ asset('frontend/assets/img/img7.jpg') }}"
                                alt="">
                            <div class="card-body text-center">
                                <h5 class="card-title">Kindergarten Classes</h5>
                                <p class="card-text">Cultivating curious minds through play-based learning, setting the
                                    foundation for lifelong exploration at Sacred Heart's nurturing Kindergarten.</p>
                            </div>
                            <center>
                                <a href="{{ route('apply') }}" class="btn px-4 mx-auto mb-4 text-center"
                                    style="background-color: rgb(31, 30, 112); color: white;">Join Now</a>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class="border-0 bg-light shadow-sm pb-2">
                            <img class="card-img-top mb-2" src="{{ asset('frontend/assets/img/img6.jpg') }}"
                                alt="">
                            <div class="card-body text-center">
                                <h5 class="card-title">Nursery Classes</h5>
                                <p class="card-text">A loving start to education, our Nursery provides a secure environment
                                    for early socialization, language skills, and joyful discovery.</p>
                            </div>

                            <center>
                                <a href="{{ route('apply') }}" class="btn px-4 mx-auto mb-4 text-center"
                                    style="background-color: rgb(31, 30, 112); color: white;">Join Now</a>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class=" border-0 bg-light shadow-sm pb-2">
                            <img class="card-img-top mb-2" src="{{ asset('frontend/assets/img/img2.jpg') }}"
                                alt="">
                            <div class="card-body text-center">
                                <h5 class="card-title">Primary Classes</h5>
                                <p class="card-text">Where young minds flourish, combining academics, character
                                    development, and critical thinking, preparing students for success and a love for
                                    learning.</p>
                            </div>
                            <center>
                                <a href="{{ route('apply') }}" class="btn px-4 mx-auto mb-4 text-center"
                                    style="background-color: rgb(31, 30, 112); color: white;">Join Now</a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Class End -->


    <!-- Team Start -->
    @if ($team->count() > 0)
        <div class="container pt-2">
            <div class="container">
                <div class="text-center pb-2">
                    <p class="section-title px-5"><span class="px-2">Our Teachers</span></p>
                    <h1 class="mb-4">Meet Our Staffs</h1>
                </div>
                <div class="row d-flex justify-content-center">
                    @foreach ($team as $tea)
                        <div class="col-md-6 col-lg-3 text-center team mb-5">
                            <div class="position-relative overflow-hidden mb-4 d-"
                                style="border-radius: 100%; border: 1px solid #eee; height:250px">
                                <img class=" w-100" src="{{ asset($tea->avatar) }}" alt="sacred-heart-school-team">
                                <div
                                    class="team-social d-flex align-items-center justify-content-center w-100 h-100 position-absolute">
                                    <a class="btn btn-outline-light text-center mr-2 px-0"
                                        style="width: 38px; height: 38px;" href="{{ $tea->social_tw }}"><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-outline-light text-center mr-2 px-0"
                                        style="width: 38px; height: 38px;" href="{{ $tea->social_fb }}"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-outline-light text-center px-0" style="width: 38px; height: 38px;"
                                        href="{{ $tea->social_ig }}"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <h3>{{ $tea->name }}</h3>
                            <i>{{ $tea->role }}</i>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Team End -->


    <!-- Testimonial Start -->
    @if ($testimonies->count() > 5)
        <div class="py-3" style="background-color: #fff;">
            <div class="container">
                <div class="container p-0">
                    <div class="text-center pb-2">
                        <p class="section-title px-5"><span class="px-2">Testimonial</span></p>
                        <h1 class="mb-4">What Parents Our Say!</h1>
                    </div>
                    <div class="owl-carousel testimonial-carousel">
                        @foreach ($testimonies as $testimony)
                            <div class="testimonial-item px-3">
                                <div class="bg-white shadow-sm rounded mb-4 p-4">
                                    <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                                    {{ $testimony->review }}
                                </div>
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{ asset('frontend/assets/img/profile.jpg') }}"
                                        style="width: 70px; height: 70px;" alt="sacred-heart-primary-school">
                                    <div class="pl-3">
                                        <h5>{{ $testimony->name }}</h5>
                                        <i>{{ $testimony->occupation }}</i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Testimonial End -->


    <!-- Blog Start -->
    @if ($posts->count() > 0)
        <div class="pt-2 bg-whit">
            <div class="container">
                <div class="text-center pb-2">
                    <p class="section-title px-5"><span class="px-2">Latest School Blog</span></p>
                    <h1 class="mb-4">Latest Articles From Our Blog</h1>
                </div>
                <div class="row pb-">
                    @foreach ($posts as $post)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <article class="article article article-style-c">
                                <div class="article-header">
                                    <div class="article-image rounded"
                                        data-background="{{ asset($post->featured_image) }}"
                                        style="background-image: url(&quot;{{ asset($post->featured_image) }}&quot;);">
                                    </div>
                                    <div class="article-title">
                                        <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                                    </div>
                                </div>
                                <div class="article-details">
                                    <div class="article-category"><a
                                            href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->title }}</a>
                                        <div class="fa fab-dot"></div> <a
                                            href="javascript: void(0)">{{ Str::upper($post->created_at->diffForHumans()) }}</a>
                                    </div>
                                    <p>
                                        {{ Str::limit($post->summary, 150, '...') }}
                                    </p>

                                    <div class="article-cta text-right">
                                        <small><a href="{{ route('blog.show', $post->slug) }}" class="text-primary">Read
                                                More <i class="fas fa-chevron-right"></i></a></small>
                                    </div>
                                </div>

                            </article>
                        </div>
                    @endforeach
                    {{-- @foreach ($posts as $post)
            <div class="col-lg-4 mb-4">
                <div class=" border-0 shadow-sm mb-2">
                    <div class="card-body bg-light p-4">
                        <img class="card-img-top mb-2" src="{{ asset($post->featured_image) }}" alt="{{ $post->slug }}">
                        <h5 class="">{{ $post->title }}</h5>
                        <div class="d-flex justify-content-start mb-3">
                            <small class="mr-3"><i class="fa fa-user text-primary"></i> <a href="{{ route('category.show', $post->category->slug) }}"></a>{{ $post->category->title }}</small>
                            <small class="mr-3"><i class="fa fa-comments text-primary"></i> {{ $post->comments->count() }}</small>
                        </div>
                        <p>{{ Str::limit($post->summary, 150, '...') }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn px-4 mx-auto my-2"
                            style="background-color: rgb(31, 30, 112); color: white;">Read More</a>
                    </div>
                </div>
            </div>
                @endforeach --}}
                </div>
            </div>
        </div>
    @endif
    <!-- Blog End -->
@endsection


@section('scripts')
    {{-- <script src="{{ asset('backend/assets/js/app.min.js') }}"></script> --}}
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

    <script>
        window.addEventListener("scroll", function() {
            // var headerText = document.getElementById("headerText");
            // var img1 = document.getElementById("img1");

            // var headerPosition = headerText.getBoundingClientRect().top;
            // var imgPosition = img1.getBoundingClientRect().top;

            // var screenHeight = window.innerHeight;

            // if (headerPosition < screenHeight) {
            //     headerText.classList.add("animate__backInLeft");
            // }
            // if (imgPosition < screenHeight) {
            //     img1.classList.add("animate__fadeIn");
            // }
        });
    </script>
@endsection
