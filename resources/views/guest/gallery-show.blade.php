@extends('guest.layouts.app')
@section('title', 'Gallery - '.$gallery->title)
@section('content')
@include('guest.includes.header', ['title' => 'Gallery', 'description' => $gallery->title])
  <div class="container">
    <h3 class="mb-4">{{ $gallery->title }}</h3>
    <p class="">{{ $gallery->description }}</p>
    <div class="gallery">

      @forelse (json_decode($gallery->photos) as $item)
          <div class="gallery-item" data-image="{{ asset($item) }}" data-title="Image 1">
          </div>
      @empty
          <p class="text-muted text-center">No photo available!</p>
      @endforelse
  </div>
  </div>
  @endsection

@section('scripts')

  <script src="{{ asset('backend/assets/js/page/light-gallery.js') }}"></script>
  <script src="{{ asset('backend/assets/bundles/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/page/gallery1.js') }}"></script>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('backend/assets/bundles/chocolat/dist/css/chocolat.css') }}">
<style>
  .gallery{display:inline-block;width:100%}.gallery .gallery-item{float:left;display:inline-block;width:150px;height:150px;background-repeat:no-repeat;background-size:cover;background-position:center;border-radius:3px;margin-right:7px;margin-bottom:7px;cursor:pointer;transition:all 0.5s;position:relative}.gallery .gallery-item:hover{opacity:0.8}.gallery .gallery-hide{display:none}.gallery .gallery-more:after{content:" ";position:absolute;left:0;top:0;width:100%;height:100%;z-index:1;background-color:rgba(0,0,0,0.5);border-radius:3px}.gallery .gallery-more div{text-align:center;line-height:50px;font-weight:600;position:relative;z-index:2;color:#fff}.gallery.gallery-md .gallery-item{width:78px;height:78px;margin-right:10px;margin-bottom:10px}.gallery.gallery-md .gallery-more div{line-height:78px}.gallery.gallery-fw .gallery-item{width:100%;margin-bottom:15px}.gallery.gallery-fw .gallery-more
</style>
@endsection