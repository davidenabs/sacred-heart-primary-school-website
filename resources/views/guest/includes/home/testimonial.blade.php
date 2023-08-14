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