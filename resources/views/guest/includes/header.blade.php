<!-- Header Start -->

<div class="container-fluid position-relative" onmousemove="moveImage(event)" style="background-color: rgb(31, 30, 112);">
    <div class="image-container">
        <div class="d-flex justify-content-between">
            <div>
                <div>
                    <img src="{{ asset('shs_images/circles/1.webp') }}" alt=" " class="moving-image" style="width: 20px;">
                    {{-- <img src="{{ asset('shs_images/circles/3.webp') }}" alt=" " class="moving-image" style="width: 20px; "> --}}
                    <img src="{{ asset('shs_images/circles/4.webp') }}" alt=" " class="moving-image d-block" style="width: 20px;">
                </div>

                <div class=" align-item-center">
                    <img src="{{ asset('shs_images/circles/3.webp') }}" alt=" " class="moving-image" style="width: 200px;">
                    <img src="{{ asset('shs_images/circles/4.webp') }}" alt=" " class="moving-image" style="width: 90px;">
                </div>
            </div>

            <div class="float-righ">
                <img src="{{ asset('shs_images/circles/2.webp') }}" alt=" " class="moving-image" style="width: 400px;">
                <img src="{{ asset('shs_images/circles/1.webp') }}" alt=" " class="moving-image" style="width: 100px;">
            </div>
        </div>
    </div>

    <div class="d-flex flex-column align-items-center justify-content-center"
    style="min-height: 150px; background-color: rgb(31, 30, 112);">
    <h3 class="display-5 font-weight-bold text-white animate__animated animate_shakeY">{{ $title }}</h3>
    <div class="d-inline-flex text-white">
        <p class="m-0 animate__animated animate__backInLeft"><a class="text-white"
                href="{{ route('home') }}">Home</a></p>
        <p class="m-0 px-2">/</p>
        <p class="m-0 animate__animated animate__backInRight" style="color: #b2bcc5">{{ $description }}</p>
    </div>
</div>



</div>
<!-- Header End -->

