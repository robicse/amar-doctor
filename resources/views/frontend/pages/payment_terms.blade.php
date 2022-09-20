@extends('frontend.layouts.master')
@section('title','Terms And Condition')
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
                    <h1>Payment Terms</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li>Payment Terms</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- about-style-two -->
    <section class="about-style-two">
        <div class="auto-container">
            {!! $paymentTerms->value !!}
        </div>
    </section>
    <!-- about-style-two end -->


@endsection
