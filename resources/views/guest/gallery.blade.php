@extends('guest.layouts.app')
@section('title', 'Gallery')

@section('content')
    @include('guest.includes.header', ['title' => 'Gallery', 'description' => 'Our Gallery'])


    <!-- Gallery Start -->
    <div class="bg-white py-1">
        <div class="container text-center">
            <p class="section-title px-5"><span class="px-2">Our Gallery</span></p>
            <h1 class="">The School Gallery</h1>
        </div>
    </div>
    @foreach ($galleries as $gallery)
    @php
        $galleryPhotos = json_decode($gallery->photos);
        $firstFourPhotos = array_slice($galleryPhotos, 0, 4);
    @endphp

    <div class="{{ $loop->index % 2 ? 'bg-light' : '' }}">
        <div class="container pt-5 pb-3">
            <div class="row align-items-center ">
                <div class="col-lg-6">
                    <p class="section-title pr-5"><span class="pr-2">Gallery</span></p>
                    <h3 class="mb-4">{{ $gallery->title }}</h3>
                    <p class="">{{ $gallery->description }}</p>
                    <a href="{{ route('gallery.show', $gallery->slug) }}" class="btn px-4 mx-auto my-2 shs-bg-primary-color text-white">View
                        More</a>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        @foreach ($firstFourPhotos as $item)
                        <div class="col-lg-3 col-md-3 col-12 thumb">
                            <a href="{{ asset($item) }}" class="fancybox" rel="ligthbox">
                                <img src="{{ asset($item) }}"
                                    class="zoom img-fluid border shadow-sm reveal fade-right" alt="">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

