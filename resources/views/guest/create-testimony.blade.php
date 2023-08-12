@extends('guest.layouts.app')
@section('title', 'Give us a review')
@section('content')
@include('guest.includes.header', ['title' => 'Testimony', 'description' => 'Give a review about our school'])


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Let's here from you</span></p>
                <h1 class="mb-4"> </h1>
            </div>
            <div class="justify-content-center row">

                <div class="col-lg-7 mb-5">
                    @include('includes.alert')
                    <div class="contact-form">
                        <div id="success"></div>
                        <form action="{{ route('testimony.store') }}" method="POST" name="sentMessage" id="contactForm" novalidate="novalidate">
                            @csrf
                            <div class="control-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" autocomplete="off" class="form-control" id="name"
                                    placeholder="Your Name" required="required"
                                    data-validation-required-message="Please enter your name" value="{{ old('name') }}" />
                                @error('name')
                                    <p class="text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" autocomplete="off" class="form-control" id="email"
                                    placeholder="Your Email" required="required"
                                    data-validation-required-message="Please enter your email" value="{{ old('email') }}" />
                                @error('email')
                                    <p class="text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <label for="occupation">Occupation</label>
                                <input type="text" name="occupation" autocomplete="off" class="form-control" id="occupation"
                                    placeholder="Your Occupation (optional)"
                                    value=" {{ old('occupation') }}" />
                                @error('occupation')
                                    <p class="text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <label for="review">Review</label>
                                <textarea class="form-control" rows="6" name="review" id="review" placeholder="Your Review"
                                    required="required" data-validation-required-message="Please give a review">{{ old('review') }}</textarea>
                                @error('review')
                                    <p class="text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn py-2 px-4" type="submit" id="sendMessageButton"
                                    style="background-color: rgb(31, 30, 112); width: 200px;
                                  color: white;">Send
                                    Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
