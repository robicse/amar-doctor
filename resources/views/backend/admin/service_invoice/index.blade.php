<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<link rel="icon" type="image/png" sizes="32x32" href="{{asset('backend/images/favicon-32x32.png')}}">--}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/backend/images/logo512.png')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('backend/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/custome-style.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">


    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('backend/plugins/daterangepicker/daterangepicker.css')}}">


    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{--toastr js--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<style>


    .column {
        float: left;
        width: 33.33%;
        padding: 5px;
    }
    .column p{
     margin-top: -16px;
    }

    /* Clearfix (clear floats) */
    .row::after {
        content: "";
        clear: both;
        display: table;


    }
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->

                        <div class="header" style="background-color: #eaeaea">
                        <div class="row">
                                <div class="column">
                                    <img src="{{asset('/backend/images/pathao.png')}}"  alt="Snow" style="width:50%;margin-top: 25px">
                                </div>
                                <div class="column" >
                                    <h2  style="margin-top: 25px"><b>Invoice</b></h2>
                                </div>
                                <div class="column" >
                                    <p style="text-align: left;font-size: 15px;margin-top: 25px">
                                     <b>Receipt</b>: 75766  <br>
                                       <b> Payment Type</b>: SSL<br>
                                       <b>Date</b> : 2 Sept,2021<br>
                                    </p>
                                </div>
                            </div>

                        </div>



                        <div class="row">
                            <div class="column" style="margin-top:35px">
                                <p ><b>Doctor Information:</b></p>
                                <p >Name:Dr.Md.Mohbubullslom </p>
                                <p >Degree:MBBS, PGT (ENT)</p>
                                <p >Speciality: ENT,GenerolPhysicion,Covid</p>
                            </div>
                            <div class="column" style="margin-top:35px">
                                <p><b>Patient Information:</b></p>
                                <p>Name:Ashique </p>
                                <p>Age:50 Yrs</p>
                                <p>Gender:Male</p>
                            </div>
                            <div class="column" style="margin-top:35px">
                                <p><b>Billlng Information:</b></p>
                                <p>Name:Meem</p>
                                <p>Mobile:01711111111</p>
                                <p>E-mail: meem@gmail.com</p>
                            </div>
                        </div>


                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tbody>
                                        <tr>
                                            <td>Consultation Fees</td>
                                            <td>500 tk</td>
                                        </tr>
                                        <tr>
                                            <td>Discount </td>
                                            <td>20 tk</td>
                                        </tr>
                                        <tr>
                                            <td>Vat</td>
                                            <td>30 tk</td>
                                        </tr>
                                        <tr>
                                            <td>Total Paid</td>
                                            <td>510 tk</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

{{--                        <div class="row" >--}}
{{--                                <div class="table"  style="width: 75%;margin-left: 70%">--}}
{{--                                    <table class="table table-striped">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>Description</th>--}}
{{--                                            <th>Subtotal</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <td>Consultation Fees</td>--}}
{{--                                            <td>$64.50</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Discount </td>--}}
{{--                                            <td>$64.50</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td>Vat</td>--}}
{{--                                            <td>$64.50</td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                        </div>--}}
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">

                            <a class="btn btn-info waves-effect" href="{{route('admin.h_service.invoice.print',$telemedicine_invoice->id)}}"> download </a>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>


<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('backend/dist/js/demo.js')}}"></script>


</body>
</html>
