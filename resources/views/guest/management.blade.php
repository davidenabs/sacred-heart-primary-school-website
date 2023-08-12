@extends('guest.layouts.app')
@section('title', 'Our management')
@section('content')
@include('guest.includes.header', ['title' => 'Management', 'description' => 'Our Management'])


  <div class="container">
      <p class="text-blk team-head-text">
        Our Staff
      </p>
      @if ($team->count() > 0)
      <div class="row">
        @foreach ($team as $tea)
        <div class="col-md-3 mb-4 col-12 reveal fade-right">
          <div class="card card-border">
            <div class="team-image-wrapper">
              <img class="team-member-image" src="{{ asset($tea->avatar) ?? asset('frontend/assets/img/profile.jpg') }}">
            </div>
            <p class="text-blk name">
              {{ $tea->name }}
            </p>
            <p class="text-blk position">
              {{ $tea->role }}
            </p>
            <p class="text-blk feature-text">
              {{ $tea->bio }}
            </p>
            <div class="social-icons">
              {{-- <a href="https://www.whatsapp.com" target="_blank">
                <img class="twitter-icon" src="{{ asset('frontend/assets/img/whatsapp.svg') }}">
              </a>
              <a href="https://www.whatsapp.com" target="_blank">
                <img class="twitter-icon" src="{{ asset('frontend/assets/img/whatsapp.svg') }}">
              </a>
              <a href="https://www.facebook.com" target="_blank">
                <img class="facebook-icon" src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/Icon-1.svg">
              </a> --}}
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @else
          <p class="text-muted text-center">No staffs available!</p>
      @endif
    </div>

@endsection
