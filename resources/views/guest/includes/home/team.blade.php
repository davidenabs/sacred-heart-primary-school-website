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
