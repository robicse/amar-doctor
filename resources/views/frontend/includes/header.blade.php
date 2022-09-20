
<!-- main header -->
<header class="main-header style-two">

    <!-- header-lower -->
    <div class="header-lower">
        <div class="auto-container">
            <div class="outer-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{route('index')}}"><img src="{{asset('frontend/assets/images/pathao.png')}}" alt=""></a></figure>
                </div>
                <div class="menu-area">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation  clearfix">
                                <li class="{{Request::is('/') ? 'current' :''}}"><a href="{{route('index')}}">Home</a> </li>
                                <li><a href="{{url('/#feature')}}">How It's Works</a></li>
                                <li ><a href="{{url('/#doctor')}}">Doctors</a> </li>
                                <li class="{{Request::is('about-us*') ? 'current' :''}}"><a href="{{route('about.us')}}">About</a></li>
{{--                                <li><a href="#testimonial">Testimonials</a></li>--}}
{{--                                <li><a href="#team">Team</a></li>--}}
                                <li><a href="{{route('blog')}}">Blog</a></li>
{{--                                <li><a href="http://localhost/doctor-pathao/public/#faq">FAQ's</a></li>--}}
                                 <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="btn-box"><a target="_blank" href="https://play.google.com/store/apps/details?id=com.doctorpathao.patient" class="theme-btn-one"><i class="icon-image"></i>Login</a></div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="outer-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{route('index')}}"><img src="{{asset('frontend/assets/images/pathao.png')}}" alt=""></a></figure>
                </div>
                <div class="menu-area">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="btn-box"><a href="register-page.html" class="theme-btn-one"><i class="icon-image"></i>Login</a></div>
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="{{route('index')}}"><img src="{{asset('frontend/assets/images/pathao.png')}}" alt="" title=""></a></div>
        <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li>Chicago 12, Melborne City, USA</li>
                <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                <li><a href="mailto:info@example.com">info@example.com</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="index.html"><span class="fab fa-twitter"></span></a></li>
                <li><a href="index.html"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="index.html"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="index.html"><span class="fab fa-instagram"></span></a></li>
                <li><a href="index.html"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div><!-- End Mobile Menu -->

