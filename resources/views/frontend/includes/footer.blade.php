<style>
    .footer-bottom {
        padding: 13px 0px;
    }
    .footer-top {
        padding: 169px 0px 30px 0px;
    }
    .agent-section .inner-container {
        padding: 25px 25px;
    }
</style>

<!-- agent-section -->
<section class="agent-section" style="margin-top: 20px">
    <div class="auto-container">
        <div class="inner-container bg-color-2">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 left-column">
                    <div class="content_block_3">
                        <div class="content-box">
                            <h3>Emergency call</h3>
                            <div class="support-box">
                                <div class="icon-box"><i class="fas fa-phone"></i></div>
                                <span>Telephone</span>
                                <h3><a href="tel:11165458856">+8801770163481</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                    <div class="content_block_4">
                        <div class="content-box">
                            <h3>Sign up for Email</h3>
                            <form action="http://azim.commonsupport.com/Docpro/index.html" method="post" class="subscribe-form">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Your Email" required="">
                                    <button type="submit" class="theme-btn-one">Submit now<i class="icon-Arrow-Right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- agent-section -->

<!-- main-footer -->
<footer class="main-footer">
    <div class="footer-top">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{asset('frontend/assets/images/shape/shape-30.png')}});"></div>
            <div class="pattern-2" style="background-image: url({{asset('frontend/assets/images/shape/shape-31.png')}});"></div>
        </div>
        <div class="auto-container">
            <div class="widget-section">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget logo-widget">
                            <figure class="footer-logo"><a href="{{url('/')}}"><img src="{{asset('frontend/assets/images/pathao.png')}}" alt=""></a></figure>
                            <div class="text">
                                <p>Doctor Pathao is a reputed online based medical service provider in Bangladesh. We are working to wipe out good punishment services in every part of Bangladesh. At Doctor Pathao, we believe that health is the root of all happiness.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h3>About</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links clearfix">
                                    <li><a href="{{route('about.us')}}">About Us</a></li>
                                    <li><a href="{{url('/#feature')}}">How It Works</a></li>
                                    <li><a href="{{url('/#blog')}}">Blog</a></li>
                                    <li><a href="{{url('/faq')}}">FAQ's</a></li>
                                    <li><a href="{{url('/#client')}}">Client</a></li>
                                    <li><a href="{{route('contact')}}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget links-widget">
                            <div class="widget-title">
                                <h3>Useful Links</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="links clearfix">
                                    <li><a href="{{url('paymentTerms')}}">Payment Terms</a></li>
                                    <li><a href="https://play.google.com/store/apps/details?id=com.doctorpathao.patient" target="_blank">Download App</a></li>
                                    <li><a href="https://play.google.com/store/apps/details?id=com.doctorpathao.doctor" target="_blank">Join as a Doctor</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="footer-widget contact-widget">
                            <div class="widget-title">
                                <h3>Contacts</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="info-list clearfix">
                                    <li><i class="fas fa-map-marker-alt"></i>
                                        House: #492/1, 4th floor, Lane: #09 Baridhara, DOHS<br />Dhaka 1206
                                    </li>
                                    <li><i class="fas fa-microphone"></i>
                                        <a href="tel:8801770163481">+8801770163481</a>
                                    </li>
                                    <li><i class="fas fa-envelope"></i>
                                        <a href="mailto:info@example.com">info@doctorpathao.com</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-box clearfix">
                <div class="copyright pull-left"><p><a href="index.html">Doctor Pathao</a> &copy; 2020 All Right Reserved</p></div>
                <ul class="footer-nav pull-right clearfix">
                    <li><a href="{{route('termsAndCondition')}}">Terms of Service</a></li>
                    <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- main-footer end -->
<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-arrow-up"></span>
</button>
