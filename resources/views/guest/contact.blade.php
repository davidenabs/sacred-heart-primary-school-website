@extends('guest.layouts.app')
@section('title', 'Contact us')
@section('content')
@include('guest.includes.header', ['title' => 'Contact Us', 'description' => 'Contact'])


    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Get In Touch</span></p>
                <h1 class="mb-4">Contact Us For Any Enquiry</h1>
            </div>
            <div class="row">
                <div class="col-lg-7 mb-5">
                    @include('includes.alert')
                    <div class="contact-form">
                        <div id="success"></div>
                        <form method="POST" action="{{ route('contact.send') }}" name="sentMessage" id="contactForm" novalidate="novalidate">
                            @csrf
                            <div class="control-group mb-3">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" required="required"
                                    data-validation-required-message="Please enter your name" />
                                @error('name')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Your Email" required="required"
                                    data-validation-required-message="Please enter your email" />
                                @error('email')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <input type="text" name="subject" class="form-control" id="subject"
                                    placeholder="Subject" required="required"
                                    data-validation-required-message="Please enter a subject" />
                                @error('subject')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="control-group mb-3">
                                <textarea class="form-control" rows="6" name="message" id="message" placeholder="Message"
                                    required="required" data-validation-required-message="Please enter your message"></textarea>
                                @error('message')
                                    <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>

                                <button class="btn py-2 px-4" type="submit" id="sendMessageButton"
                                    style="background-color: rgb(31, 30, 112); width: 200px;
                                  color: white;">Send
                                    Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-5">
                    <p>Welcome to Sacred Heart Primary School, where we are dedicated to providing a nurturing environment for academic excellence and personal growth.</p>
                    <div class="d-flex">
                        <i class="fa fa-map-marker-alt d-inline-flex align-items-center justify-content-center rounded-circle"
                            style="width: 45px; height: 45px;  background-color: rgb(31, 30, 112); color: white;"></i>
                        <div class="pl-3">
                            <h5>Address</h5>
                            <p>46 independence way Kaduna, Kaduna State</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="fa fa-envelope d-inline-flex align-items-center justify-content-center rounded-circle"
                            style="width: 45px; height: 45px;  background-color: rgb(31, 30, 112); color: white;"></i>
                        <div class="pl-3">
                            <h5>Email US:</h5>
                            <p>sacredheartprimaryschkad@gmail.com </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="fa fa-phone-alt d-inline-flex align-items-center justify-content-center rounded-circle"
                            style="width: 45px; height: 45px; background-color: rgb(31, 30, 112); color: white;"></i>
                        <div class="pl-3">
                            <h5>Phone</h5>
                            <p>+23480 6071 7501</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <i class="fa fa-clock d-inline-flex align-items-center justify-content-center rounded-circle"
                            style="width: 45px; height: 45px;  background-color: rgb(31, 30, 112); color: white;"></i>
                        <div class="pl-3">
                            <h5>Opening Hours</h5>
                            <strong>Monday - Friday:</strong>
                            <p class="m-0">08:00 AM - 05:00 PM </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@section('styles')
    <!-- Include script -->
   <script type="text/javascript">
    function callbackThen(response) {

      // read Promise object
      response.json().then(function(data) {
        console.log(data);
        if(data.success && data.score >= 0.6) {
           console.log('valid recaptcha');
        } else {
           document.getElementById('contactForm').addEventListener('submit', function(event) {
              event.preventDefault();
              alert('recaptcha error');
           });
        }
      });
    }

    function callbackCatch(error){
       console.error('Error:', error)
    }
    </script>

    {!! htmlScriptTagJsApi([
       'callback_then' => 'callbackThen',
       'callback_catch' => 'callbackCatch',
    ]) !!}
@endsection
