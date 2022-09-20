@extends('frontend.layouts.master')
@section('title','Frequently Asked Questions.')
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
                    <h1>Frequently Asked Questions.</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li>Frequently Asked Questions.</li>
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
{{--                            <div class="sec-title">--}}
{{--                                <h2>Frequently Asked Questions</h2>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
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
                                        <li class="accordion block">
                                            <div class="acc-btn">
                                                <div class="icon-outer"></div>
                                                <h4>Who provides medical consultation on Doctor Pathao?</h4>
                                            </div>
                                            <div class="acc-content">
                                                <div class="text">
                                                    <p>
                                                        Only certified MBBS doctors can offer advice through the Doctor Pathao app or Website.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="accordion block">
                                            <div class="acc-btn">
                                                <div class="icon-outer"></div>
                                                <h4>Is the registered doctor verified?</h4>
                                            </div>
                                            <div class="acc-content">
                                                <div class="text">
                                                    <p>
                                                        Yes, the panel of all our doctors has been verified. We check their registration at BMDC. We also check the National Identity Card / Passport of the doctors along with the selfie to make sure that the qualified doctors are being registered.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="accordion block">
                                            <div class="acc-btn">
                                                <div class="icon-outer"></div>
                                                <h4>When are the doctors free for medical counsel?</h4>
                                            </div>
                                            <div class="acc-content">
                                                <div class="text">
                                                    <p>
                                                        Specialist doctors are accessible as per their time accessibility. Our foundation is accessible every minute of every day. Any specialist can come online whenever they need.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="accordion block">
                                            <div class="acc-btn">
                                                <div class="icon-outer"></div>
                                                <h4>Would we be able to choose a specialist willingly?</h4>
                                            </div>
                                            <div class="acc-content">
                                                <div class="text">
                                                    <p>
                                                        Indeed, surely, you can choose any specialist who is enrolled in our Doctor Pathao application and site. At the point when you look for a specialist, we will show all of you specialists accessible for your chosen strength. You can channel/sort by cost and different boundaries. At the point when you observe the specialist you need to get a conference with, you can pick that specialist to get a discussion with.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="accordion block">
                                            <div class="acc-btn">
                                                <div class="icon-outer"></div>
                                                <h4>Would we be able to choose a specialist willingly?</h4>
                                            </div>
                                            <div class="acc-content">
                                                <div class="text">
                                                    <p>
                                                        Indeed, surely, you can choose any specialist who is enrolled in our Doctor Pathao application and site. At the point when you look for a specialist, we will show all of you specialists accessible for your chosen strength. You can channel/sort by cost and different boundaries. At the point when you observe the specialist you need to get a conference with, you can pick that specialist to get a discussion with.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="accordion block">
                                            <div class="acc-btn">
                                                <div class="icon-outer"></div>
                                                <h4>How would I make an installment?</h4>
                                            </div>
                                            <div class="acc-content">
                                                <div class="text">
                                                    <p>
                                                        Indeed, surely, you can choose any specialist who is enrolled in our Doctor Pathao application and site. At the point when you look for a specialist, we will show all of you specialists accessible for your chosen strength. You can channel/sort by cost and different boundaries. At the point when you observe the specialist you need to get a conference with, you can pick that specialist to get a discussion with.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="accordion block">
                                            <div class="acc-btn">
                                                <div class="icon-outer"></div>
                                                <h4>How would I get a solution for my recommendation?</h4>
                                            </div>
                                            <div class="acc-content">
                                                <div class="text">
                                                    <p>
                                                        When the meeting is finished, the specialist will compose the solution in the application and transfer it. When you transfer the specialist's solution, you will actually want to download it right away. You will actually want to download the solution from your past ideas menu.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="accordion block">
                                            <div class="acc-btn">
                                                <div class="icon-outer"></div>
                                                <h4>Would I be able to get a meeting on the off chance that I am outside Bangladesh?</h4>
                                            </div>
                                            <div class="acc-content">
                                                <div class="text">
                                                    <p>
                                                        Indeed, you can get a meeting from anyplace on the planet utilizing our application or web administration, when approved.
                                                    </p>
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
        </div>
    </section>
    <!-- about-style-two end -->


@endsection
