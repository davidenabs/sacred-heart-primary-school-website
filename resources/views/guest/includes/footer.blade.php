<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <H5>Subcribe to our Newsletter for free</H5>
                    <p>
                        Get all our latest blog updates, news and events via our newsletter
                    </p>
                    <form action="{{ route('subscribe') }}" method="post">
                        @csrf
                        <input type="email" name="subscribe_email" autocomplete="false" required><input type="submit" value="Subscribe">
                        @error('subscribe_email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>{{ $settings->school_name ?? env('APP_NAME') }}<span>.</span></h3>
                    <p>
                        {{ $settings->about_school }}<br><br>
                        <strong>Phone:</strong> {{ env('APP_PHONE') ?? '+23480 6071 7501' }}<br>
                        <strong>Email:</strong> {{ env('APP_EMAIL_SUPPORT') ?? 'sacredheartprimaryschkad@gmail.com'  }}<br>
                        <strong>Address:</strong> {{ env('APP_EMAIL_SUPPORT') ?? '46 independence way Kaduna, Kaduna State' }}<br>
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a
                                href="{{ route('management') }}#services">Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('blog.index') }}"> News & Event</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('gallery') }}">Gallery
                                </a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>know More</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('contact') }}">Contact us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a
                                href="{{ route('about') }}"> About us</a></li>

                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Social Networks</h4>
                    <p class="text-light">Also connect with us on our social media plaforms</p>
                    <div class="social-links mt-3">
                        <a href="https://twitter.com/techmanna" class="twitter"><i
                                class="fab fa-twitter"></i></a>
                        <a href="https://facebook.com/techmanna" class="facebook"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://instagram.com/techmannang" class="instagram"><i
                                class="fab fa-instagram"></i></a>
                        {{-- <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container py-4">
        <div class="copyright">
            {{ date('Y') }} &copy; Copyright <strong><span>{{ config('app.name') }}</span></strong>. All
            Rights Reserved
        </div>
        <div class="credits">
            Developed by <a href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>
    </div>
</footer><!-- End Footer -->




{{-- <div class="container-fluid text-white mt-5 py-5 px-sm-3 px-md-5" style="background-color: rgb(31, 30, 112);">
    <div class="row pt-5 reveal fade-bottom">
        <div class="col-lg-3 col-md-6 mb-5">
            <h3 class="text-white font-weight-bold animate__animated animate__backInDown animate__delay-20000s">
                Sacred Heart <br>Primary School</h3>

            <p>One of the standout features of Sacred Heart Primary School is its commitment to personalized
                attention and student support.
                With excellent class sizes, teachers can provide individualized instruction and guidance,
                ensuring that each student's unique needs and learning styles are addressed.
            </p>
            <div class="d-md-flex justify-content-start mt-4">
                <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                    style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                    style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                    style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                    style="width: 38px; height: 38px;" href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="text-primary mb-4">Get In Touch</h5>
            <div class="d-md-flex">

                <div>
                    <h6 class="text-white"><i class="fa fa-map-marker-alt text-primary"></i> Address: </h6>
                    <p class="animate__animated animate__backInLeft text-light"> 46 independence way Kaduna, Kaduna
                        State
                    </p>
                </div>
            </div>
            <div class="d-md-flex">

                <div>
                    <h6 class="text-white"><i class="fa fa-envelope text-primary"></i> Email: </h6>
                    <a href="mailto:sacredheartprimaryschkad@gmail.com" class="text-light">
                        <p>sacredheartprimaryschkad<br>@gmail.com</p>
                    </a>
                </div>
            </div>
            <div class="d-md-flex">

                <div class="pl-1">
                    <h6 class="text-white"><i class="fa fa-phone-alt text-primary"></i> Telephone No: </h6>
                    <a href="tel:+2348060717501" class="animate__animated animate__backInRight text-light">
                        <p>+2348060717501
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="text-primary mb-4" style="padding-right: 40px;">Quick Links</h5>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-white mb-2" href="index.html"><i class="fa fa-angle-right mr-2"></i>Home</a>
                <a class="text-white mb-2" href="about.html"><i class="fa fa-angle-right mr-2"></i>About Us</a>
                <a class="text-white mb-2" href="class.html"><i class="fa fa-angle-right mr-2"></i>Management</a>
                <a class="text-white mb-2" href="blog.html"><i class="fa fa-angle-right mr-2"></i>News & Event</a>
                <a class="text-white mb-2" href="gallery.html"><i class="fa fa-angle-right mr-2"></i>Gallery</a>
                <a class="text-white mb-2" href="contact.html"><i class="fa fa-angle-right mr-2"></i>Contact</a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h5 class="text-primary mb-4">Contact Us</h5>
            <form action="">
                <div class="form-group">
                    <input type="text" class="form-control border-0 py-4" placeholder="Your Name"
                        required="required" />
                </div>
                <div class="form-group">
                    <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                        required="required" />
                </div>
                <div>
                    <button class="btn btn-block border-0 py3 bg-light" type="submit">Send Message</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid pt-5" style="border-top: 1px solid rgba(23, 162, 184, .2);;">
        <p class="m-0 text-center text-white">
            &copy; <a class="text-light font-weight-bold" href="{{ route('home') }}">Sacred Heart Primary School</a>. All Rights
            Reserved.
            <br>
            Designed by <a class="text-light font-weight-bold"
                href="https://dannycodess.netlify.app">DannyCodes</a>
        </p>
    </div>
</div> --}}