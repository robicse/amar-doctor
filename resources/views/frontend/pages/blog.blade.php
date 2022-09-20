@extends('frontend.layouts.master')
@section('title','Blog')
<style>

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
                    <h1>Blog Grid</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <div class="auto-container">
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li>Blog </li>
                </ul>
            </div>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- news-section -->
    <section class="blog-grid">
        <div class="auto-container">
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
                                <h3><a  href="{{route('blog-details',$blog->slug)}}">{{$blog->title}}</a></h3>

{{--                                <p>{{$blog->short_description}}</p>--}}
                                <p>{!!  Str::limit($blog->description, 30) !!}</p>
                                <div class="link"><a  href="{{route('blog-details',$blog->slug)}}"><i class="icon-Arrow-Right"></i></a></div>
                                <div class="btn-box"><a  href="{{route('blog-details',$blog->slug)}}" class="theme-btn-one">Read more<i class="icon-Arrow-Right"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
{{--            <div class="pagination-wrapper centred">--}}
{{--                <ul class="pagination">--}}
{{--                    <li><a href="clinic-1.html" class="current">1</a></li>--}}
{{--                    <li><a href="clinic-1.html">2</a></li>--}}
{{--                    <li><a href="clinic-1.html">3</a></li>--}}
{{--                    <li><a href="clinic-1.html"><i class="icon-Arrow-Right"></i></a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div>
    </section>
    <!-- news-section end -->



@endsection
