@extends('frontend.layouts.master')
@section('title','About')
<style>

</style>
@section('content')


    <!--Page Title-->
    <section class="page-title centred bg-color-1">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-70.png')}});"></div>
            <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-71.png')}});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>About Us</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- about-style-two -->
    <section class="about-style-two">
        <div class="auto-container">
            <div class="row align-items-center clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_1">
                        <div class="content-box mr-50">
                            <div class="sec-title">
                                <p>About Doctor Pathao</p>
                                <h2>Bring care to your home with one click</h2>
                            </div>
                            <div class="text">
                                <p>Doctor Pathao is a reputed online based medical service provider in Bangladesh. We are working to wipe out good punishment services in every part of Bangladesh. At Doctor Pathao, we believe that health is the root of all happiness.</p>
                                <p>Our main goal is to provide appropriate services in any field related to the health of the general public. You will find with us the desired professional doctor for any punishment you need. Through which you can easily receive various consultations through telemedicine services from home.</p>
                                <p>In addition to this, we are conducting a doctor home service for the first time in Bangladesh for your needs. With this you will not have to go to any medical without any hassle, our specialist doctors will be at your service all the time in your need. In this way, our professional doctors will be able to visit your home and provide appropriate services.</p>
                                <p>
                                    We offer expert advice as well as online prescription, drug supply, pathology / diagnostic tests. This allows you to deliver medicine, lab reports, and payments from home through our Doctor Pathao Up. Our main concern is to ensure good quality healthcare at affordable prices.
                                </p>
                                <h2>Our Mission</h2>
                                <p>Our goal is to ensure the well-being of the common people and to take more care of their health. Our main objective is to ensure your health care through skilled doctors with advanced technology.</p>
                                <h2>
                                    Our Vision
                                </h2>
                                <p>Our goal is to make telemedicine services easier across the country. This will enable the general public to get expert advice on various health information they need.</p>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_3">
                        <div class="image-box">
                            <div class="pattern">
                                <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-49.png')}});"></div>
                                <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-50.png')}});"></div>
                                <div class="pattern-3"></div>
                            </div>
                            <figure class="image image-1 paroller"><img src="{{asset('frontend/assets/images/resource/about-4.jpg')}}" alt=""></figure>
                            <figure class="image image-2 paroller-2"><img src="{{asset('frontend/assets/images/resource/about-3.jpg')}}" alt=""></figure>
                            <div class="image-content">
                                <figure class="icon-box"><img src="{{asset('frontend/assets/images/icons/icon-8.png')}}" alt=""></figure>
                                <span>Appointment With</span>
                                <h4>Specialist</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-style-two end -->


@endsection
