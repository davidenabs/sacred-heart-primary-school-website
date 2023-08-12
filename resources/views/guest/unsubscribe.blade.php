@extends('guest.layouts.app')
@section('title', 'Unsubscriber')
@section('content')

    <div class="container pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Unsubscribe</span></p>
                <h1 class="mb-4"></h1>

            </div>
            <div class="row justify-content-center text-center">
                <div class="col-lg-5 mb-5">
                    <p>We're sorry to see you go. If you unsubscribe, you'll miss out on our latest updates and news.</p>
                    <p>If you still want to unsubscribe, just click the button below:</p>
                    @include('includes.alert')
                    <form method="POST" action="{{ route('unsubscribe.user') }}" novalidate="novalidate">
                        @csrf
                        @if (isset($email) && $email != '')
                        <button class="btn py-2 px-4" type="submit" id="sendMessageButton"
                        style="background-color: rgb(31, 30, 112); width: 200px;
                      color: white;">Unsubscribe</button>
                        @endif
                    </form>
                    <p class="mt-3">Thank you for being part of our community!</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Include script -->
    <script type="text/javascript">
        function callbackThen(response) {

            // read Promise object
            response.json().then(function(data) {
                console.log(data);
                if (data.success && data.score >= 0.6) {
                    console.log('valid recaptcha');
                } else {
                    document.getElementById('contactForm').addEventListener('submit', function(event) {
                        event.preventDefault();
                        alert('recaptcha error');
                    });
                }
            });
        }

        function callbackCatch(error) {
            console.error('Error:', error)
        }
    </script>

    {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch',
    ]) !!}
@endsection
