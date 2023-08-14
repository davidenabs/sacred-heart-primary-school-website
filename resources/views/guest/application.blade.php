@extends('guest.layouts.app')
@section('title', 'Application')
@section('content')
    <!--Application session-->
<div class="container py-5">
    <div class="">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <p class="section-title pr-5"><span class="pr-2">School Application</span></p>
                <h1 class="mb-4">Apply For Your Kid</h1>
                <p>Sacred heart Primary School, Independence Way, Kaduna is a Catholic school.
                    Admission are opened to pupils going to age 5 into primary one.
                    </p>
                <ul class="list-inline m-0">
                    <li class="py-2"><i class="fa fa-check text-success mr-3"></i>Application can be downloaded using the button below</li>
                    <li class="py-2"><i class="fa fa-check text-success mr-3"></i>Application forms for admissions are on sale all year</li>
                    <li class="py-2"><i class="fa fa-check text-success mr-3"></i>It can also be obtained through the school Administrative office</li>
                </ul>
                <a href="{{ route('download.app.form') }}" class="btn mt-4 py-2 px-4 shs-bg-primary-color text-white">Download</a>
            </div>
            <div class="col-lg-5">
                <div class=" border-0 revealfade-right" style="width: 400px;">
                    <div class="card-header  text-center p-4 shs-bg-primary-color">
                        <h1 class="text-white m-0">Book A Seat</h1>
                    </div>
                    <div class="card-body rounded-bottom p-5 shs-bg-primary-color">
                        <form action="https://mail.google.com/mail/?view=cm&fs=1&to=info@sacredheartprimaryschool.org&su=Applying For Admission&body=&bcc=email">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 p-4" placeholder="Your Name" required />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 p-4" placeholder="Your Email" required />
                            </div>
                            <div class="form-group">
                                <select name="class" class="custom-select border-0 px-4" style="height: 47px;" required>
                                    <option selected>Select A Class</option>
                                    <option value="Pre-Nursery">Pre-Nursery</option>
                                    <option value="Nursery">Nursery</option>
                                    <option value="Primary">Primary</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-block border-0 py-2 btn-light" type="submit" style="padding-bottom: 20px;" id="downloadButton">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection