@extends('backend.layouts.master')
@section("title","Business Settings")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/custom-datepicker.css')}}">
    <style>

    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Business Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Business Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content" style="margin-top: 50px">
        <div class="row">
            <div class="col-8 offset-2">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Business Settings</h3>
                        <div class="float-right">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                        <div class="card-body">
                            <label>Home Service Day Cost <small class="text-info" >(Home Service Day Cost {{$h_service_day_cost->value}} tk.) </small></label>
                            <form id="h_service_day_cost">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" name="id" value="{{$h_service_day_cost->id}}">
                                    <input type="number" class="form-control" name="value" value="{{$h_service_day_cost->value}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>

                            <label>Home Service Night Cost <small class="text-info" >(Home Service Night Cost {{$h_service_night_cost->value}} tk.)</small></label>
                            <form id="h_service_night_cost">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" name="id" value="{{$h_service_night_cost->id}}">
                                    <input type="number" class="form-control" name="value" value="{{$h_service_night_cost->value}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>

                            <label>Vat<small class="text-info" >(Vat amount will be  percent {{$vat->value}}(%) for all.)</small></label>
                            <form id="vat">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" name="id" value="{{$vat->id}}">
                                    <input type="number" class="form-control" name="value" value="{{$vat->value}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                            <label>Specialist Doctor's Percentage for Telemedicine<small class="text-info" > ( {{$special_dr_percentage->value}}(%) will deducted from Specialist Doctor Fees. For Service Charge.)</small></label>
                            <form id="special_dr_percentage">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" name="id" value="{{$special_dr_percentage->id}}">
                                    <input type="number" class="form-control" name="value" value="{{$special_dr_percentage->value}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>

                            <label>Sp.Doctor's Percentage for Home Service<small class="text-info" > ( {{$sp_dr_home_service_percentage->value}}(%) will get for home service.)</small></label>
                            <form id="sp_dr_home_service_percentage">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" name="id" value="{{$sp_dr_home_service_percentage->id}}">
                                    <input type="number" class="form-control" name="value" value="{{$sp_dr_home_service_percentage->value}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>

                            <label>Secmo Doctor's Percentage<small class="text-info" > ({{$secmo_dr_percentage->value}}(%) tk will get Secmo Doctor For home service.)</small></label>
                            <form id="secmo_dr_percentage">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" name="id" value="{{$secmo_dr_percentage->id}}">
                                    <input type="number" class="form-control" name="value" value="{{$secmo_dr_percentage->value}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>

                            <label>Delivery Man Get<small class="text-info" >( {{$delivery_man_cost->value}}(%) tk. will deduct from delivery cost (70tk). For service charge.)</small></label>
                            <form id="delivery_man_cost">
                                <div class="input-group mb-3">
                                    <input type="hidden" class="form-control" name="id" value="{{$delivery_man_cost->id}}">
                                    <input type="number" class="form-control" name="value" value="{{$delivery_man_cost->value}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                            <label>Offer Start Time<small class="text-info" >(Offer Start At {{$offer_start_time->value}})</small></label>
                            <form id="offer_start_time">
                                <div class="input-group mb-3 timepicker_div" id="timepicker">
                                    <input type="hidden" class="form-control" name="id" value="{{$offer_start_time->id}}">
                                    <input type="text" class="form-control datetimepicker-input timepicker" name="value"  value="{{$offer_start_time->value}}" data-target="#timepicker"/>
                                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                            <label>Offer End Time<small class="text-info" >(Offer End At {{$offer_end_time->value}})</small></label>
                            <form id="offer_end_time">
                                <div class="input-group mb-3 timepicker_div" id="timepicker">
                                    <input type="hidden" class="form-control" name="id" value="{{$offer_end_time->id}}">
                                    <input type="text" class="form-control datetimepicker-input timepicker" name="value"  value="{{$offer_end_time->value}}" data-target="#timepicker"/>
                                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                            <label>Offer Status<small class="text-info" ></small></label>
                            <form id="offer_status">
                                <div class=" input-group form-group">
                                    <input type="hidden" class="form-control" name="id" value="{{$offer_status->id}}">
                                    <input type="hidden" class="form-control " name="value"  value="{{$offer_status->value}}"/>
                                    <select name="value" id="value" class="form-control" required>
                                        <option value="0" {{$offer_status->value== 0 ? 'selected' : ""}}>Stop</option>
                                        <option value="1" {{$offer_status->value== 1 ? 'selected' : ""}}>Running</option>

                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                            <label>Home Service Start Time<small class="text-info" >(Home Service Start At {{$h_service_start_time->value}})</small></label>
                            <form id="h_service_start_time">
                                <div class="input-group mb-3 timepicker_div" id="timepicker">
                                    <input type="hidden" class="form-control" name="id" value="{{$h_service_start_time->id}}">
                                    <input type="text" class="form-control datetimepicker-input timepicker" name="value"  value="{{$h_service_start_time->value}}" data-target="#timepicker"/>
                                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                            <label>Home Service End Time<small class="text-info" >(Home Service End At {{$h_service_end_time->value}})</small></label>
                            <form id="h_service_end_time">
                                <div class="input-group mb-3 timepicker_div" id="timepicker">
                                    <input type="hidden" class="form-control" name="id" value="{{$h_service_end_time->id}}">
                                    <input type="text" class="form-control datetimepicker-input timepicker" name="value"  value="{{$h_service_end_time->value}}" data-target="#timepicker"/>
                                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                            <label>Home Service Status<small class="text-info" ></small></label>
                            <form id="h_service_status">
                                <div class=" input-group form-group">
                                    <input type="hidden" class="form-control" name="id" value="{{$h_service_status->id}}">
                                    <input type="hidden" class="form-control " name="value"  value="{{$h_service_status->value}}"/>
                                    <select name="value" id="value" class="form-control" required>
                                        <option value="0" {{$h_service_status->value== 0 ? 'selected' : ""}}>Stop</option>
                                        <option value="1" {{$h_service_status->value== 1 ? 'selected' : ""}}>Running</option>

                                    </select>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/plugins/custom-datepicker.js')}}"></script>
    <script>

        $(document).ready(function(){
            $('.timepicker').mdtimepicker();
        });



    //for h_service_day_cost update
        $("#h_service_day_cost").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                url: "{{url('/admin/h_service_day_cost/update')}}",
                type: 'POST',
                data: $('#h_service_day_cost').serialize(),
                success: function(data) {
                   // console.log(data);
                    toastr.success('Home Service Day cost Updated Successfully');
                }
            });
        })

        //for h_service_night_cost update
        $("#h_service_night_cost").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/h_service_night_cost/update')}}',
                data: $('#h_service_night_cost').serialize(),
                success: function(data) {
                    // console.log(data);
                    toastr.success('Home Service Night Cost Value Updated Successfully');
                }
            });
        })

        //for vat update

        $("#vat").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/vat/update')}}',
                data: $('#vat').serialize(),
                success: function(data) {
                    // console.log(data);
                    toastr.success('Vat Value Updated Successfully');
                }
            });
        })

        //for special_dr_percentage update

        $("#special_dr_percentage").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/special_dr_percentage/update')}}',
                data: $('#special_dr_percentage').serialize(),
                success: function(data) {
                    // console.log(data);
                    toastr.success('Special Doctor Percentage Value Updated Successfully');
                }
            });
        })

        // sp doctor get home service percentage
        $("#sp_dr_home_service_percentage").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/special_dr_home_service_percentage/update')}}',
                data: $('#sp_dr_home_service_percentage').serialize(),
                success: function(data) {
                    // console.log(data);
                    toastr.success('Special Doctor Home Service Percentage Value Updated Successfully');
                }
            });
        })

        //for secmo_dr_percentage update

        $("#secmo_dr_percentage").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/secmo_dr_percentage/update')}}',
                data: $('#secmo_dr_percentage').serialize(),
                success: function(data) {
                    // console.log(data);
                    toastr.success('Secmo Doctor Percentage Value Updated Successfully');
                }
            });
        })

        //for delivery_man_cost update

        $("#delivery_man_cost").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/delivery_man_cost/update')}}',
                data: $('#delivery_man_cost').serialize(),
                success: function(data) {
                    // console.log(data);
                    toastr.success('Delivery Man Cost Value Updated Successfully');
                }
            });
        })

        //for offer_start_time update

        $("#offer_start_time").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/offer_start_time/update')}}',
                data: $('#offer_start_time').serialize(),
                success: function(data) {
                     console.log(data);
                    toastr.success('Offer Start Time Updated Successfully');
                }
            });
        })


        //for offer_end_time update

        $("#offer_end_time").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/offer_end_time/update')}}',
                data: $('#offer_end_time').serialize(),
                success: function(data) {
                     console.log(data);
                    toastr.success('Offer Start Time Updated Successfully');
                }
            });
        })

        //for offer_status update

        $("#offer_status").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/offer_status/update')}}',
                data: $('#offer_status').serialize(),
                success: function(data) {
                     console.log(data);
                    toastr.success('Offer Start Time Updated Successfully');
                }
            });
        })

//for Home service update

        $("#h_service_start_time").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/h_service_start_time/update')}}',
                data: $('#h_service_start_time').serialize(),
                success: function(data) {
                    console.log(data);
                    toastr.success('Home Service Start Time Updated Successfully');
                }
            });
        })


        //for Home service update

        $("#h_service_end_time").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/h_service_end_time/update')}}',
                data: $('#h_service_end_time').serialize(),
                success: function(data) {
                    console.log(data);
                    toastr.success('Home Service Start Time Updated Successfully');
                }
            });
        })

        //for offer_status update

        $("#h_service_status").submit(function(event){
            event.preventDefault();
            var $form = $(this);
            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            console.log(serializedData)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{url('/admin/h_service_status/update')}}',
                data: $('#h_service_status').serialize(),
                success: function(data) {
                     console.log(data);
                    toastr.success('Home Service Status Updated Successfully','Success');
                }
            });
        })


    </script>
@endpush
