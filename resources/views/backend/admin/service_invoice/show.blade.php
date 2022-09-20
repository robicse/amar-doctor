<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
{{--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
    {{--toastr js--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>
<style>


    .column {
        float: left;
        width: 33.33%;
        padding: 5px;
    }
    .column2 {
        float: left;
        width: 30%;
        padding: 5px;
    }
    .column p{
        margin-top: -21px;
        font-size: 12px;
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
                                <div class="column" style="margin-top:-25px">
                                    <img src="{{asset('/backend/images/pathao.png')}}"  alt="Snow" style="width:70%;margin-top: 37px">
                                </div>
                                <div class="column2">
                                    <h4  style="margin-top: 30px"><b>Receipt</b></h4>
                                </div>
                                <div class="column">
                                    <p style="text-align: left;font-size: 15px;margin-top: 25px">
                                        <b>Receipt No</b>: {{$telemedicine_invoice->code}}  <br>

                                    </p>
                                    <p> <b style="margin-top: -10px"> Payment Type</b>:@if($telemedicine_invoice->payment_type == 'sslcommerz') @endif SSL<br></p>
                                    <p>
                                        <b style="margin-top: -10px">Date</b> : {{ date_format($telemedicine_invoice->created_at, 'jS F,  Y')}}<br></p>
                                </div>
                            </div>

                        </div>



                        <div class="row" >
                            @php
                                $specialities = \App\Model\DrSpecialist::where('specialist_dr_id',$telemedicine_invoice->SpecialistDr->id)->get();
                                    //dd($specialities);
                            @endphp
                            <div class="column" style="margin-top:35px">
                                <p ><b>Doctor Information:</b></p>
                                <p >Name: {{$telemedicine_invoice->SpecialistDr->title}}{{$telemedicine_invoice->SpecialistDr->user->name}} </p>
                                <p >Degree: {{$telemedicine_invoice->SpecialistDr->professional_derees}}</p>

                                <p >Speciality:    @foreach($specialities as $specialitie) <span>{{$specialitie->speciality->name}}.</span>   @endforeach</p>

                            </div>

                            <div class="column" style="margin-top:35px">
                                <p><b>Patient Information:</b></p>
                                <p>Name: {{$telemedicine_invoice->patient->name}} </p>
                                <p>Age: {{$telemedicine_invoice->patient->age_year}}.{{$telemedicine_invoice->patient->age_month}} Yrs</p>
                                <p>Gender: {{$telemedicine_invoice->patient->gender}}</p>
                            </div>
                            <div class="column" style="margin-top:35px">
                                <p><b>Biller Information:</b></p>
                                <p>Name:Doctor Pathao</p>
                                <p>Mobile:01711111111</p>
                                <p>E-mail: info@doctorpathao.com</p>
                            </div>
                        </div>
                        <!-- Table row -->
                        <div class="row">
                            <div class="table-responsive">
                                <h5 style="text-align: center">Telemedicine Service</h5>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount(BDT)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Consultation Fees</td>
                                        <td>{{$telemedicine_invoice->doctor_fee}}  </td>
                                    </tr>
{{--                                    <tr>--}}
{{--                                        <td>Doctor Fees </td>--}}
{{--                                        <td>{{$telemedicine_invoice->specialist_dr_amount}}  </td>--}}
{{--                                    </tr>--}}
                                    <tr>
                                        <td>Vat</td>
                                        <td>{{$telemedicine_invoice->total_vat}} </td>
                                    </tr>
                                    <tr>
                                        <td>Total Paid</td>
                                        <td>{{$telemedicine_invoice->grand_total}} </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

{{--                        <div class="row">--}}
{{--                            <div class="table"  style="margin-left: 30%">--}}
{{--                                <table class="table table-borderless" >--}}
{{--                                        <tr>--}}
{{--                                            <th >Subtotal:$250.30</th>--}}
{{--                                            <td></td>--}}
{{--                                        </tr>--}}

{{--                                        <tr>--}}
{{--                                            <td>Shipping:$5.80</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>Total:</th>--}}
{{--                                            <td>$265.24</td>--}}
{{--                                        </tr>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                        </div>--}}
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
{{--                        <div class="row no-print">--}}

{{--                            <a class="btn btn-info waves-effect" href="{{route('admin.h_service.invoice.print',$telemedicine_invoice->id)}}"> download </a>--}}
{{--                        </div>--}}
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
