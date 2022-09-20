@extends('frontend.layouts.master')
@section('title',
$blog->title
)
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
                    <h1>{{$blog->title}}</h1>
                </div>
            </div>
        </div>
        <div class="lower-content">
            <div class="auto-container">
                <ul class="bread-crumb clearfix">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li>{{$blog->title}}</li>
                </ul>
            </div>
        </div>
    </section>
    <!--page-title-two end-->


    <!-- sidebar-page-container -->
    <section class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    <img src="{{asset('uploads/blogs/'.$blog->image)}}" alt="">
                                </figure>
                                <div class="lower-content">
                                    <h3>{{$blog->title}}</h3>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                        {!! strip_tags($blog ->description) !!}
                        <div class="post-share-option clearfix">
                            <div class="text pull-left"><h4>We Are Social On:</h4></div>
                            <ul class="social-links clearfix pull-right">
                                <li><a href="blog-details.html"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="blog-details.html"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="blog-details.html"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h3>Recent Posts</h3>
                            </div>
                            <div class="post-inner">
                                @foreach($latestBlogs as $latestBlog)
                                <div class="post">
                                    <figure class="post-thumb"><a href="{{route('blog-details',$latestBlog->slug)}}"><img src="{{asset('uploads/blogs/'.$latestBlog->image)}}" alt=""></a></figure>
                                    <h5><a href="{{route('blog-details',$latestBlog->slug)}}">{{$latestBlog->title}}</a></h5>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container end -->


@endsection
