@extends('guest.layouts.app')
@section('title', 'About us')
@section('content')
@include('guest.includes.header', ['title' => 'About Us', 'description' => 'About Us'])

    <div class="container py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <p class="section-title pr-5"><span class="pr-2">About</span></p>
                    <h1 class="mb-4">Our History</h1>
                    <p class=""><strong>SACRED HEART PRIMARY School was established in the year 1965. <br>
                            <br>It is one of the best primary schools in Kaduna, located at independence Way,
                            <br>Kaduna, Kaduna State.
                            <br><br>
                            Sacred Heart Primary School helps the young generations develop their writing <br>
                            skills and preare them all ready for the <br> secondary education before graduation.
                            <br><br>
                            Sacred Heart Primary School has produced <br>
                            high quality graduates who have <br>proceeded into diverse fields of studies <br>
                            and have contributed and continuing to <br>
                            contribute positively to the development of <br>
                            our great country, Nigeria and its <br>
                            economies as a whole.</strong></p>
                </div>
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-5 mb-lg-0" src="{{ asset('frontend/assets/images/about.jpg') }}"
                        alt="{{ config('app.name') }}"
                        style="width: 500px; height: 250px animation: fadeIn 5s; @keyframes fadeIn {
                    0%{opacity: 0;}
                    100% {opacity: 1;}
                }">
                </div>
            </div>
        </div>
    </div>


    <!-- About Start -->

    <!-- History Section -->
    <hr class="m-0 p-0">
    <div class="light-g-blue py-4">
        <div class="container reveal fade-left">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class=" w-100 rounded mb-5 mb-lg-0" src="{{ asset('frontend/assets/images/mission.jpg') }}"
                        alt="{{ config('app.name') }} Mission">
                </div>
                <div class="col-lg-7">
                    <p class="section-title pr-5"><span class="light-g-blue pr-2">About</span></p>
                    <h1 class="mb-4 a">Our Mission</h1>
                    <p><strong>School vision statements outline a school's values and objectives. <br>
                            They provide parents and the community a brief but clear overview
                            <br>of the overall ethos of the school. On the other hand, school<br> mission statements
                            explains what the school is currently
                            doing to achieve its vision. Schools need both vision and mission <br>statements to show
                            their community what their values and benefits <br> are.
                            <br> We believe that a happy child is a successful one. We are <br>
                            committed to providing a positive, safe and supportive <br>
                            environment for the children to learn, where all are valued. We intend <br>
                            that all children should enjoy their learning, achieve their <br>potentials and
                            become independent life-long learners. </p>
                </div>
            </div>
        </div>
    </div>
    <hr class="m-0 p-0">
    <!-- Part Two About Section -->
    <div class="container reveal fade-right">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <p class="section-title pr-5"><span class="pr-2">About</span></p>
                <h1 class="mb-4 animate__animated animate__backInLeft">Our Vision</h1>
                <p class="animate__animated animate__backInRight"> OUR VISION is to build a community where all
                    children feel loved,
                    respected and encouraged to develop to their fullest potentials.</p>

            </div>
            <div class="col-lg-5">
                <img class="w-100 rounded mb-5 mb-lg-0" src="{{ asset('frontend/assets/images/vision.jpg') }}" alt="{{ config('app.name') }} Vision">
            </div>
        </div>
    </div>
    <hr class="m-0 p-0">
    <!-- Our Moral Values -->

    <div class="light-g-blue py-4">
        <div class="container reveal fade-left">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="w-100 rounded mb-5 mb-lg-0" src="{{ asset('frontend/assets/images/vector-student.png') }}" alt="{{ config('app.name') }} Moral Values"
                        style="">
                </div>
                <div class="col-lg-7">
                    <p class="section-title pr-5"><span class="pr-2">About</span></p>
                    <h1 class="mb-4 a">Our Moral Values</h1>
                    <p><strong style="color: green;">Community Spirit: <br>
                            Joining students, parents, alumni,<br> faculty and staff into one great <br>
                            community, Sacred Heart Primary School offers a connection for life. <br><br>
                            <strong style="color: palevioletred;">Technologically <br>Innovative: <br>
                                Integrating, powerful information<br> technology with all facets of academic <br>
                                performance.</strong>
                            <br><br>
                            <strong style="color: orangered;">Academically Vital: <br>
                                Cultivating intellectual curiosity <br>
                                through innovative-students centered</strong> <br><br>
                            <strong style="color: #5e4dcd;"> Globally Inquisitive: <br>
                                Welcoming students from around the <br>world into a diverse, lively and first class
                                school environment.</strong></p>
                </div>
            </div>
        </div>
    </div>
    <hr class="m-0 p-0">
    <!-- Admission Section -->
    <div class="py-4">
        <div class="container reveal fade-bottom">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <p class="section-title pr-5"><span class="pr-2">About</span></p>
                    <h1 class="mb-4 animate__animated animate__backInLeft">Our Admission Guideline:</h1>
                    <p class="animate__animated animate__backInRight"><strong style="color: black;">Sacred Heart Primary
                            School, Independence Way, Kaduna is catholic school. Admissions <br>
                            are opened to pupils going to age 5 into primary<br>
                            one. <br><br>
                            <strong style="color: rgb(204, 100, 62);"
                                class="animate__animated animate__backInRight">Application Form: <br></strong>
                            Application forms for admissions are on sale all year <br>
                            through and are obtainable from the school <b>Administrative Office.</b></strong></p>

                </div>
                <div class="col-lg-5">
                    <img class="w-100 rounded mb-5 mb-lg-0 reveal fade-in"
                        src="{{ asset('frontend/assets/images/admission.png') }}" alt="{{ config('app.name') }} Admission Guideline">
                </div>
            </div>
        </div>
    </div>

    <!-- About End -->
@endsection
