@extends('backend.layouts.master')
@section("title"," Details ")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"> Details </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header  bg-info">
                                <h3 class="card-title">Delivery Man Section</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label" >Name</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" value="{{$delivery_man_show_request->delivery_man_user_id}}" name="delivery_man_user_id" class="form-control" id="inputName" >
                                        <a href="#">  <input type="test"  readonly  value="{{$delivery_man_show_request->deliveryMan->user->name}}" class="form-control" id="inputName"></a>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label" >Phone</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" value="" name="user_id" class="form-control" id="inputName" >
                                        <a href="#">   <input type="test"  readonly  value="{{$delivery_man_show_request->deliveryMan->user->phone}}" class="form-control" id="inputName"></a>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label" style="color: red" >Status</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" value="" name="user_id" class="form-control" id="inputName" >
                                        <a href="#">   <input type="test"  readonly value="{{$delivery_man_show_request->status}}" class="form-control" id="inputName"></a>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header  bg-info">
                                <h3 class="card-title">User Section</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label" >Name</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" name="patient_user_id"  value="{{$delivery_man_show_request->patient_user_id}}" class="form-control" id="inputName" >
                                        <a href="#">  <input type="hidden" readonly  value="{{$delivery_man_show_request->user_name}}" class="form-control" id="inputName"></a>
                                        <a href="#">  <input type="test" readonly  value="{{$delivery_man_show_request->user->name}}" class="form-control" id="inputName"></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <a href="#">    <input type="text" readonly   value="{{$delivery_man_show_request->user->phone}}" class="form-control" id="inputEmail"></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <a href="#">    <input type="text" readonly   value="{{$delivery_man_show_request->user_address}}" class="form-control" id="inputEmail"></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <!-- Profile Image -->
                        <div class="card card-outline">
                            <div class="card-header  bg-info">
                                <h3 class="card-title">About Delivery</h3>
                            </div>
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center"></h3>

                                <p class="text-muted text-center"></p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Delivery Charge</b>: <a href="#"><span style="font-size: 20px;">৳</span> {{$delivery_man_show_request->delivery_charge}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Delivery Man Charge </b> :<a href="#"> <span style="font-size: 20px;">৳</span> {{$delivery_man_show_request->delivery_man_cost}}</a>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <div class="col-md-6">
                        <!-- Profile Image -->
                        <div class="card card-outline">
                            <div class="card-header  bg-info">
                                <h3 class="card-title">About Prescription</h3>
                            </div>
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center"></h3>
                                <p class="text-muted text-center"></p>
                                <ul class="list-group list-group-unbordered mb-3">

                                    @if ($delivery_man_show_request->prescription_id != null)
                                        <li class="list-group-item">
                                            <b style="font-size: 20px;color:#e72228">E-prescription</b> :<a href="{{$delivery_man_show_request->prescription_id != null ? route('admin.prescription.download',$delivery_man_show_request->prescription->id) : "#"}}" target="_blank" style="font-size: 20px"> Download</a>
                                        </li>
                                    @endif
                                    @if($delivery_man_show_request->is_prescription_photo != null)
                                    <li class="list-group-item" >
                                        <b style="font-size: 20px;color:#e72228">Prescription Image </b> :<a href="{{asset('uploads/prescription_photo/'.$delivery_man_show_request->is_prescription_photo)}}" target="_blank" style="font-size: 20px">
                                           Image</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- Default box -->
        </div>
        <!-- /.card -->
    </section>

@stop
@push('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'details' );
    </script>
@endpush
