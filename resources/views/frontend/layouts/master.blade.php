<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

{{--    <meta name="description" content="Doctor Pathao">--}}

    <meta name="description" content="Doctor Pathoa big home service and telemedicine service app.">


    <meta name="author" content="root">
    <title>@yield('title') | Doctor Pathao</title>

    <!-- Favicon -->
{{--    <link rel="shortcut icon" href="{{asset('frontend/assets/images/favicon.png')}}">--}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/backend/images/logo512.png')}}">

<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

    <!--  CSS Style -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/color.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">



    {{--toastr css--}}
    <style>
        @media only screen and (max-width: 600px) {
            .header-sticky {
                position: fixed!important;
                top: 0;
                z-index: 9999999;
            }
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @stack('css')
</head>


<body>

<div class="boxed_wrapper">


@include('frontend.includes.header')

@yield('content')

@include('frontend.includes.footer')


</div>

<!-- Include Scripts -->
<script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/owl.js')}}"></script>
<script src="{{asset('frontend/assets/js/wow.js')}}"></script>
<script src="{{asset('frontend/assets/js/validation.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('frontend/assets/js/appear.js')}}"></script>
<script src="{{asset('frontend/assets/js/scrollbar.js')}}"></script>
<script src="{{asset('frontend/assets/js/tilt.jquery.js')}}"></script>
<script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/script.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


@stack('js')
{!! Toastr::message() !!}
<script>
    function showFrontendAlert(type, message){
        if(type == 'danger'){
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>
<script>
    @if($errors->any())
    @foreach($errors->all() as $error )
    toastr.error('{{$error}}','Error',{
        closeButton:true,
        progressBar:true
    });
    @endforeach
    @endif


    $(document).ready(function() {


    })





</script>
</body>

</html>
