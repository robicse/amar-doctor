@extends('backend.layouts.master')
@section("title","Edit Coupon")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Coupon</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Coupon</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Edit Coupon</h3>
                        <div class="float-right">
                            <a href="{{route('admin.coupon.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>


                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.coupon.update', $coupon->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="card-body">

                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="title">Code</label>
                                        <input type="text" class="form-control" name="code" id="code" value="{{$coupon->code}}"
                                               placeholder="Enter Title">
                                    </div>
{{--                                    <div class="form-group ">--}}
{{--                                        <label for="image">Discount Type</label>--}}
{{--                                        <br>--}}
{{--                                        <select name="discount_type" id="discount_type" class="form-control" >--}}
{{--                                            <option value="flat" {{$coupon->discount_type=='flat' ? "selected" : ""}}>flat</option>--}}
{{--                                            <option value="percentage"  {{$coupon->discount_type=='percentage' ? "selected" : ""}}>percentage</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                    <div class="form-group col-md-6">
                                        <label for="image">Discount Amount</label>
                                        <br>
                                        <input type="text" id="discount_amount" class="form-control" name="discount" value="{{$coupon->discount}}">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="image">Start Time</label>
                                        <br>
                                        <input type="date" class="form-control" name="start_date" id="start_date"
                                               placeholder="Enter Start Time" value="{{$coupon->start_date}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="image">End Time</label>
                                        <br>
                                        <input type="date" class="form-control" name="end_date" id="end_date"
                                               placeholder="Enter End Time" value="{{$coupon->end_date}}">
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="image">Description</label>
                                <br>
                                <textarea name="details" id="details" rows="3" class="form-control">{!! $coupon-> details!!}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
    <script>

        $('.demo-select2').select2();

    </script>
    <script>
        function coupon_form(){
            var coupon_type = $('#coupon_type').val();
            var id = $('#id').val();
            $.post('{{ route('admin.coupon.get_coupon_form_edit') }}',{_token:'{{ csrf_token() }}', coupon_type:coupon_type, id:id}, function(data){
                $('#coupon_form').html(data);

                $('#demo-dp-range .input-daterange').datepicker({
                    startDate: '-0d',
                    todayBtn: "linked",
                    autoclose: true,
                    todayHighlight: true
                });
            });
        }

        $(document).ready(function(){
            coupon_form();
        });
    </script>
@endpush
