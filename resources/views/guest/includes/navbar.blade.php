<div class="container-fluid bg-light position-fixed position-sticky shs-bg-primary-color shadow" style="top: 0;
        transition: background-color 0.3s ease;
        z-index: 9999;
      ">
        <nav class="navbar navbar-expand-lg navbar-light py-3 py-lg-0 px-0 px-lg-5">
            <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
                <span class="text-primary"><img src="{{ asset('shs/logo/sacred-heart-primary-school-kaduna.webp') }}" class="logo"></span>

            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav font-weight-bold mx-auto py-0">
                    <a href="{{ route('home') }}" class="nav-item nav-link">Home</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link">About Us</a>
                    <a href="{{ route('management') }}" class="nav-item nav-link">Management</a>
                    <a href="{{ route('blog.index') }}" class="nav-link">News & Event</a>
                    <a href="{{ route('gallery') }}" class="nav-item nav-link">Gallery</a>
                    <a href="{{ route('contact') }}" class="nav-item nav-link">Contact Us</a>
                </div>
                <a href="{{ route('apply') }}" class="btn px-4 shs-bg-primary-color text-white"
                    >Apply Now</a>
            </div>
        </nav>
    </div>

    {{-- <div class="container-fluid bg-light position-fixed position-sticky  shadow" style="top: 0;
      background-color: rgb(31, 30, 112);
        transition: background-color 0.3s ease;
        background-color: rgb(31, 30, 112);
        z-index: 9999;
      ">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
            <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
                <span class="text-primary"><img src="img/logo.jpg" class="logo"></span>

            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav font-weight-bold mx-auto py-0">
                    <a href="index.html" class="nav-item nav-link">Home</a>
                    <a href="about.html" class="nav-item nav-link">About Us</a>
                    <a href="management.html" class="nav-item nav-link">Management</a>
                    <div class="nav-item dropdown">
                        <a href="blog.html" class="nav-link">News & Event</a>
                        <div class="dropdown-menu rounded-0 m-0">

                        </div>
                    </div>
                    <a href="gallery.html" class="nav-item nav-link">Gallery</a>
                    <a href="contact.html" class="nav-item nav-link">Contact Us</a>
                </div>
                <a href="application.html" class="btn px-4"
                    style="background-color: rgb(31, 30, 112); color: white;">Apply Now</a>
            </div>
        </nav>
    </div> --}}