@extends('frontend.layouts.master')
@section('title','Home')
<style>
    .clients-section {
        padding: 50px 0px;
    }
    .process-section {
        position: relative;
        padding: 25px 0px 60px 0px!important;
    }
    html {
        scroll-behavior: smooth;
    }

</style>
@section('content')

    <!-- banner-section -->
    <section class="banner-section style-four">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-60.png')}});"></div>
            <div class="pattern-2" style="background-image:url({{asset('frontend/assets/images/shape/shape-55.png')}});"></div>
            <div class="pattern-3" style="background-image:url({{asset('frontend/assets/images/shape/shape-61.png')}});"></div>
            <div class="pattern-4" style="background-image:url({{asset('frontend/assets/images/shape/shape-62.png')}});"></div>
{{--            <div class="pattern-5" style="background-image:url({{asset('frontend/assets/images/shape/shape-6.png')}});"></div>--}}
        </div>
        <div class="image-box">
            <div class="anim-icon">
                <div class="icon icon-1 rotate-me" style="background-image: url({{asset('frontend/assets/images/icons/anim-icon-9.png')}});"></div>
                <div class="icon icon-2 float-bob-y" style="background-image: url({{asset('frontend/assets/images/icons/anim-icon-10.png')}});"></div>
                <div class="icon icon-3 rotate-me" style="background-image: url({{asset('frontend/assets/images/icons/anim-icon-11.png')}});"></div>
                <div class="icon icon-4"></div>
                <div class="icon icon-5" style="background-image: url({{asset('frontend/assets/images/icons/anim-icon-9.png')}});"></div>
            </div>
            <figure class="image clearfix js-tilt"><img src="{{asset('frontend/assets/images/banner/banner-image-2.png')}}" alt=""></figure>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-xl-6 col-lg-12 col-md-12 content-column">
                    <div class="content-box">
                        <h1>Find Nearest Doctor.</h1>
                        <p>Download and register on our app for free and feel safe for all your family.</p>
                        <div class="form-inner">
                            <div class="btn-box"><a href="https://play.google.com/store/apps/details?id=com.doctorpathao.patient" target="_blank" class="theme-btn-one">Download App<i class="icon-Arrow-Right"></i></a></div>
{{--                            <ul class="select-box clearfix">--}}
{{--                                <li>--}}
{{--                                    <div class="single-checkbox">--}}
{{--                                        <input type="radio" name="check-box" id="check1" checked="">--}}
{{--                                        <label for="check1"><span></span>All</label>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <div class="single-checkbox">--}}
{{--                                        <input type="radio" name="check-box" id="check2">--}}
{{--                                        <label for="check2"><span></span>Doctor</label>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <div class="single-checkbox">--}}
{{--                                        <input type="radio" name="check-box" id="check3">--}}
{{--                                        <label for="check3"><span></span>Clinic</label>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature-section -->
    <section class="feature-section alternat-2 centred " id="feature">
        <div class="auto-container">
            <div class="sec-title centred">
                <h2>Home Service Process</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern">
                                <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-5.png')}});"></div>
                                <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-9.png')}});"></div>
                            </div>
                            <figure class="icon-box"><img src="{{asset('frontend/assets/images/icons/icon-1.png')}}" alt=""></figure>
                            <p>Appointment With</p>
                            <h3>Nearest SACMO</h3>
                            <div class="link"><a href="/"><i class="icon-Arrow-Right"></i></a></div>
                            <div class="btn-box"><a href="/" class="theme-btn-one">Step One<i class="icon-Arrow-Right"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern">
                                <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-6.png')}});"></div>
                                <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-10.png')}});"></div>
                            </div>
                            <figure class="icon-box"><img src="{{asset('frontend/assets/images/icons/icon-2.png')}}" alt=""></figure>
                            <p>Live Video CAll</p>
                            <h3>Doctor</h3>
                            <div class="link"><a href="/"><i class="icon-Arrow-Right"></i></a></div>
                            <div class="btn-box"><a href="/" class="theme-btn-one">Step Two<i class="icon-Arrow-Right"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern">
                                <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-7.png')}});"></div>
                                <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-11.png')}});"></div>
                            </div>
                            <figure class="icon-box"><img src="{{asset('frontend/assets/images/icons/icon-4.png')}}" alt=""></figure>
                            <p>Appoinment With Top</p>
                            <h3>Specialist</h3>
                            <div class="link"><a href="/"><i class="icon-Arrow-Right"></i></a></div>
                            <div class="btn-box"><a href="/" class="theme-btn-one">Step Three<i class="icon-Arrow-Right"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern">
                                <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-8.png')}});"></div>
                                <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-12.png')}});"></div>
                            </div>
                            <figure class="icon-box"><img src="{{asset('frontend/assets/images/icons/icon-4.png')}}" alt=""></figure>
                            <p>24/7 Active Support</p>
                            <h3>Help Support</h3>
                            <div class="link"><a href="/"><i class="icon-Arrow-Right"></i></a></div>
                            <div class="btn-box"><a href="/" class="theme-btn-one">Step Four<i class="icon-Arrow-Right"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature-section end -->

    <!-- process-section -->
    <section class="process-section bg-color-2" style="margin-top: 20px">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-17.png')}});"></div>
            <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-18.png')}});"></div>
            <div class="pattern-3" style="background-image: url({{asset('frontend/assets/images/shape/shape-19.png')}});"></div>
            <div class="pattern-4" style="background-image: url({{asset('frontend/assets/images/shape/shape-20.png')}});"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title light centred">
                <p>Process</p>
                <h2> Telemedicine Process</h2>
            </div>
            <div class="inner-content">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                        <div class="processing-block-one">
                            <div class="inner-box">
                                <figure class="icon-box">
                                    <img src="{{asset('frontend/assets/images/icons/icon-5.png')}}" alt="">
                                    <span>01</span>
                                </figure>
                                <h3>Search Best Online Doctor</h3>
                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod ex tempor incididunt.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                        <div class="processing-block-one">
                            <div class="inner-box">
                                <figure class="icon-box">
                                    <img src="{{asset('frontend/assets/images/icons/icon-6.png')}}" alt="">
                                    <span>02</span>
                                </figure>
                                <h3>View Professional Profile</h3>
                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod ex tempor incididunt.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 processing-block">
                        <div class="processing-block-one">
                            <div class="inner-box">
                                <figure class="icon-box">
                                    <img src="{{asset('frontend/assets/images/icons/icon-7.png')}}" alt="">
                                    <span>03</span>
                                </figure>
                                <h3>Get Instant Doctor Service</h3>
                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod ex tempor incididunt.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- process-section end -->
    <!-- team-section -->
    <section class="team-section" id="doctor">
        <div class="auto-container">
            <div class="sec-title centred">
                <p>Meet Our Professionals</p>
                <h2>Top Rated Specialists</h2>
            </div>
            <div class="row clearfix">
                @foreach($doctors as $doctor)
                <div class="col-lg-6 col-md-6 col-sm-12 team-block">
                    <div class="team-block-one wow fadeInLeft animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="pattern">
                                <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-24.png')}});"></div>
                                <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-25.png')}});"></div>
                            </div>
                            <figure class="image-box"><img src="{{asset('uploads/profile/'.$doctor->user->avatar_original)}}" alt=""></figure>
                            <div class="content-box">
{{--                                <div class="like-box"><a href="index.html"><i class="far fa-heart"></i></a></div>--}}
                                <ul class="name-box clearfix">
                                    <li class="name"><h3><a href="doctors-details.html">{{$doctor->title}}{{$doctor->user->name}}</a></h3></li>
                                    <li><i class="icon-Trust-1"></i></li>
                                    <li><i class="icon-Trust-2"></i></li>
                                </ul>
                                <span class="designation">{{$doctor->professional_derees}}</span>
                                <div class="text">
                                    <p>{{$doctor->about}}.</p>
                                </div>
{{--                                <div class="rating-box clearfix">--}}
{{--                                    <ul class="rating clearfix">--}}
{{--                                        <li><i class="icon-Star"></i></li>--}}
{{--                                        <li><i class="icon-Star"></i></li>--}}
{{--                                        <li><i class="icon-Star"></i></li>--}}
{{--                                        <li><i class="icon-Star"></i></li>--}}
{{--                                        <li><i class="icon-Star"></i></li>--}}
{{--                                        <li><a href="index.html">(32)</a></li>--}}
{{--                                    </ul>--}}
{{--                                    <div class="link"><a href="index.html">Available Today</a></div>--}}
{{--                                </div>--}}
                                <div class="location-box">
                                    <p><i class="fas fa-map-marker-alt"></i>{{$doctor->user->address}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="more-btn centred"><a href="#" class="theme-btn-one">All Specialist<i class="icon-Arrow-Right"></i></a></div>
        </div>
    </section>
    <!-- team-section end -->

    <!-- testimonial-section -->
    <section class="testimonial-section bg-color-3">
        <div class="bg-layer" style="background-image: url({{asset('frontend/assets/images/background/testimonial-1.jpg')}});"></div>
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-22.png')}});"></div>
            <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-23.png')}});"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-xl-7 col-lg-12 col-md-12 inner-column">
                    <div class="testimonial-inner">
                        <div class="pattern" style="background-image: url({{asset('frontend/assets/images/shape/shape-21.png')}});"></div>
                        <div class="sec-title">
                            <p>Testimonials</p>
                            <h2>What client’s say?</h2>
                        </div>
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none nav-style-one">
                            <div class="testimonial-block-one">
                                <div class="inner-box">
                                    <div class="text">
                                        <p>“ Lorem ipsum dolor sit amet consectetur adipic  eksed do eiusmod tempor incid unt labore dolore magna Aliqua.enim minim veniam, quis nostrud. “</p>
                                    </div>
                                    <div class="author-info">
                                        <figure class="author-thumb"><img src="{{asset('frontend/assets/images/resource/testimonial-1.png')}}" alt=""></figure>
                                        <h3>Amelia Anna</h3>
                                        <span class="designation">Amelia Anna</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-block-one">
                                <div class="inner-box">
                                    <div class="text">
                                        <p>“ Lorem ipsum dolor sit amet consectetur adipic  eksed do eiusmod tempor incid unt labore dolore magna Aliqua.enim minim veniam, quis nostrud. “</p>
                                    </div>
                                    <div class="author-info">
                                        <figure class="author-thumb"><img src="{{asset('frontend/assets/images/resource/testimonial-1.png')}}" alt=""></figure>
                                        <h3>Amelia Anna</h3>
                                        <span class="designation">Amelia Anna</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-block-one">
                                <div class="inner-box">
                                    <div class="text">
                                        <p>“ Lorem ipsum dolor sit amet consectetur adipic  eksed do eiusmod tempor incid unt labore dolore magna Aliqua.enim minim veniam, quis nostrud. “</p>
                                    </div>
                                    <div class="author-info">
                                        <figure class="author-thumb"><img src="{{asset('frontend/assets/images/resource/testimonial-1.png')}}" alt=""></figure>
                                        <h3>Amelia Anna</h3>
                                        <span class="designation">Amelia Anna</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial-section end -->


    <!-- cta-section -->
    <section class="cta-section bg-color-2">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-17.png')}});"></div>
            <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-18.png')}});"></div>
            <div class="pattern-3" style="background-image: url({{asset('frontend/assets/images/shape/shape-19.png')}});"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <figure class="image"><img src="{{asset('frontend/assets/images/resource/phone-1.png')}}" alt=""></figure>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_2">
                        <div class="content-box">
                            <div class="sec-title light">
                                <p>Download apps</p>
                                <h2>For Better Test Download Mobile App</h2>
                            </div>
                            <div class="text">
                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor incididunt labore dolore magna.</p>
                            </div>
                            <div class="btn-box clearfix">
                                <a href="#" class="download-btn app-store">
                                    <i class="fab fa-apple"></i>
                                    <span>Download on</span>
                                    <h3>App Store</h3>
                                </a>
                                <a href="https://play.google.com/store/apps/details?id=com.doctorpathao.patient" target="_blank" class="download-btn play-store">
                                    <i class="fab fa-google-play"></i>
                                    <span>Download on</span>
                                    <h3>Google Play</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta-section end -->


    <!-- news-section -->
    <section class="news-section" id="blog">
        <div class="auto-container">
            <div class="sec-title centred">
                <p>Blog & Article</p>
                <h2>Stay Update With Doctor Pathao</h2>
            </div>
            <div class="row clearfix">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{asset('uploads/blogs/'.$blog->image)}}" alt="">
                                <a href="{{route('blog-details',$blog->slug)}}" class="link"><i class="fas fa-link"></i></a>
{{--                                <span class="category">Featured</span>--}}
                            </figure>
                            <div class="lower-content">
                                <h3><a href="{{route('blog-details',$blog->slug)}}">{{$blog->title}}</a></h3>

                                <p>{!!  Str::limit($blog->description, 30) !!}</p>
                                <div class="link"><a href="{{route('blog-details',$blog->slug)}}"><i class="icon-Arrow-Right"></i></a></div>
                                <div class="btn-box"><a href="{{route('blog-details',$blog->slug)}}" class="theme-btn-one">Read more<i class="icon-Arrow-Right"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- news-section end -->



    <!-- faq-section -->
    <section class="faq-section" id="faq">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_4">
                        <div class="image-box">
                            <div class="pattern" style="background-image: url({{asset('frontend/assets/images/shape/shape-54.png')}});"></div>
                            <figure class="image"><img src="{{asset('frontend/assets/images/resource/faq-1.png')}}" alt=""></figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_5">
                        <div class="content-box">
                            <div class="sec-title">
                                <p>Faq’s</p>
                                <h2>Frequently Asked Questions.</h2>
                            </div>
                            <ul class="accordion-box">
                                <li class="accordion block active-block">
                                    <div class="acc-btn active">
                                        <div class="icon-outer"></div>
                                        <h4>What is Doctor Pathao?</h4>
                                    </div>
                                    <div class="acc-content current">
                                        <div class="text">
                                            <p>Doctor Pathao is a Bangladeshi online-based medical consultation service provider. Where you can get services from 24/7 specialist doctors through video calls on any type of health-related topic.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block ">
                                    <div class="acc-btn ">
                                        <div class="icon-outer"></div>
                                        <h4>What kind of medical services do we provide?</h4>
                                    </div>
                                    <div class="acc-content ">
                                        <div class="text">
                                            <p>
                                                Common health issue: You may have heard of a common health issue affecting the world today. It is an autoimmune disorder that causes inflammation in the body and can lead to many serious ailments. Some common symptoms of this disorder are headache, dizziness, fever, fatigue, and a red rash on the skin. It is important to know what this condition is called and how you can identify it in order to prevent it from becoming more severe which could lead to death.
                                            </p>
                                            <p>
                                                Doctor advice: Doctor advice is important for anyone with a common health issue. This includes something as simple as not feeling well or experiencing pain. A healthcare professional can offer invaluable information and treatment options to help you feel better. Your doctor may be able to provide you with a diagnosis, let you know what treatments are available to you, and tell you how to identify and prevent the condition from happening again.
                                            </p>
                                            <p>
                                                Mental health and wellbeing: According to the World Health Organization, mental health disorders are among the most prevalent of all health problems. Mental health can be defined in many ways, but most experts agree that it is more than the absence of a disorder. It includes social, emotional, psychological, and spiritual wellbeing. Everyone has mental health, even if they do not have a diagnosable disorder. Mental problems are inherently different from other medical conditions because they are often socially stigmatized or taboos.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"></div>
                                        <h4>How does Doctor Pathao work?</h4>
                                    </div>
                                    <div class="acc-content">
                                        <div class="text">
                                            <p>
                                                Our Doctor Pathao app has available advice for both patients and the people around them. Redo from scratch:
                                            </p>
                                            <ul>
                                                <li>
                                                    1.	Find the relevant specialists, name your condition, and way to communicate with a doctor - typically by video call

                                                   </li>
                                                <li>
                                                    2.	Pay for services delivered
                                                </li>
                                                <li>
                                                    3.	Make an appointment
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq-section end -->

    <!-- clients-section -->
    <div class="sec-title centred" id="client" style="margin-top: 25px">
        <h2>Our Partners</h2>
    </div>
    <section class="clients-section bg-color-2"  style="margin-top: 20px">

        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-3.png')}});"></div>
            <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-4.png')}});"></div>
        </div>
        <div class="auto-container">
            <div class="auto-container">

                <div class="clients-carousel owl-carousel owl-theme owl-nav-none owl-dots-none">
                    <figure class="clients-logo-box"><a href="#"><img src="{{asset('frontend/assets/images/clients/clients-logo-1.png')}}" alt=""></a></figure>
                    <figure class="clients-logo-box"><a href="#"><img src="{{asset('frontend/assets/images/clients/clients-logo-2.png')}}" alt=""></a></figure>
                    <figure class="clients-logo-box"><a href="#"><img src="{{asset('frontend/assets/images/clients/clients-logo-3.png')}}" alt=""></a></figure>
                    <figure class="clients-logo-box"><a href="#"><img src="{{asset('frontend/assets/images/clients/clients-logo-4.png')}}" alt=""></a></figure>
                    <figure class="clients-logo-box"><a target="_blank" href="https://www.sslcommerz.com/"><img src="{{asset('frontend/assets/img/ssl.png')}}" alt=""></a></figure>
                </div>
            </div>
        </div>
    </section>
    <!-- clients-section end -->
@endsection
