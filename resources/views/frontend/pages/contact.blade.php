@extends('frontend.layouts.master')
@section('title','Contact')
<style>
    .contact-section {
        position: relative;
        padding: 40px 0px!important;
    }
</style>
@section('content')

    <!--page-title-two-->
    <section class="page-title-two">
        <div class="title-box centred bg-color-2">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-70.png')}});"></div>
                <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-71.png')}});"></div>
            </div>
            <div class="auto-container">
                <div class="title">
                    <h1>Contact</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <div class="auto-container">
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- information-section -->
    <section class="information-section sec-pad centred bg-color-3">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-88.png')}});"></div>
            <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-89.png')}});"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title centred">
                <p>Information</p>
                <h2>Get In Touch</h2>
                <p class="text-dark">We are 24x7 for any of your needs. If you have any questions about our healthcare service, please share them with us by filling out the form below. We look forward to hearing from you!</p>
            </div>
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 information-column">
                    <div class="single-information-block wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern" style="background-image: url({{asset('frontend/assets/images/shape/shape-87.png')}});"></div>
                            <figure class="icon-box"><img src="{{asset('frontend/assets/images/icons/icon-20.png')}}" alt=""></figure>
                            <h3>Email Address</h3>
                            <p>
                                <a href="mailto:info@doctorpathao.com">info@doctorpathao.com</a><br />

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 information-column">
                    <div class="single-information-block wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern" style="background-image: url({{asset('frontend/assets/images/shape/shape-87.png')}});"></div>
                            <figure class="icon-box"><img src="{{asset('frontend/assets/images/icons/icon-21.png')}}" alt=""></figure>
                            <h3>Phone Number</h3>
                            <p>
                                <a href="tel:23055873407">+8801770163481</a><br />

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 information-column">
                    <div class="single-information-block wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern" style="background-image: url({{asset('frontend/assets/images/shape/shape-87.png')}});"></div>
                            <figure class="icon-box"><img src="{{asset('frontend/assets/images/icons/icon-22.png')}}" alt=""></figure>
                            <h3>Office Address</h3>
                            <p>
                               House: #492/1, 4th floor, Lane: #09 Baridhara, DOHS<br />Dhaka 1206
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- information-section end -->


    <!-- contact-section -->
    <section class="contact-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-9 col-md-9 col-sm-9  offset-md-2 form-column">
                    <div class="form-inner">
                        <div class="sec-title">
                            <h2>Contact Us</h2>
                        </div>
                        <form method="post" action="" id="contact-form" class="default-form">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="text" name="username" placeholder="Your name" required="">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="Your email" required="">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="phone" required="" placeholder="Phone number">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="subject" required="" placeholder="Subject">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea name="message" placeholder="Your Message ..."></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                    <button class="theme-btn-one" type="submit" name="submit-form">Send Message<i class="icon-Arrow-Right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
{{--                <div class="col-lg-6 col-md-12 col-sm-12 map-column">--}}
{{--                    <div class="map-inner">--}}
{{--                        <div class="pattern" style="background-image: url({{asset('frontend/assets/images/shape/shape-90.png')}});"></div>--}}

{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>
    <!-- contact-section end -->



@endsection
