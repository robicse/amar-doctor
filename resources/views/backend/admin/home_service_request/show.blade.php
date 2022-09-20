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
{{--                    <div class="col-md-4">--}}
                        <!-- Profile Image -->
{{--                        <div class="card  card-outline">--}}
{{--                            <div class="card-header  bg-info">--}}
{{--                                <h3 class="card-title">About Patient</h3>--}}
{{--                            </div>--}}
{{--                            <div class="card-body box-profile">--}}

{{--                                <div class="text-center">--}}
{{--                                    @if(!empty($home_service_complete_request->patient->photo))--}}
{{--                                        <img class="profile-user-img img-fluid img-circle"--}}
{{--                                             src="{{asset('/uploads/patient/photo/'.$home_service_complete_request->patient->photo)}}" alt="User profile picture">--}}
{{--                                    @else--}}
{{--                                        <img class="profile-user-img img-fluid img-circle"--}}
{{--                                             src="{{asset('uploads/profile/default.png')}}" alt="User profile picture">--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                <h3 class="profile-username text-center"></h3>--}}

{{--                                <p class="text-muted text-center"></p>--}}
{{--                                <ul class="list-group list-group-unbordered mb-3">--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <b>Name</b>: <a href="#"> {{$home_service_complete_request->patient->name}}</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <b>Gender </b> :<a href="#"> {{$home_service_complete_request->patient->gender}}</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <b>Age</b> :<a href="#"> {{$home_service_complete_request->patient->age_year}}.{{$home_service_complete_request->patient->age_month}} year</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <b>Weight</b> :<a href="#"> {{$home_service_complete_request->patient->weight}}</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <b>Relationship With User :</b> <a href="#">   {{$home_service_complete_request->patient->relationship}}</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <b>Marital Status :</b> <a href="#">   {{$home_service_complete_request->patient->marital_status}}</a>--}}
{{--                                    </li>--}}

{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                        </div>--}}

{{--                    </div>--}}
                    <div class="col-md-5">
                        <!-- Profile Image -->
                        <div class="card card-outline">
                            <div class="card-header  bg-info">
                                <h3 class="card-title">About User</h3>
                            </div>
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center"></h3>

                                <p class="text-muted text-center"></p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Name</b>: <a href="#"> {{$home_service_complete_request->user->name}}</a>
                                    </li>
                                   {{-- <li class="list-group-item">
                                        <b>Address </b> :<a href="#">  {{$home_service_complete_request->user->address}}</a>
                                    </li>--}}
                                    <li class="list-group-item">
                                        <b>Email</b> :<a href="#">   {{$home_service_complete_request->user->email}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone #</b> :<a href="#">   {{$home_service_complete_request->user->phone}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Amount</b>: <a href="#"> {{$home_service_complete_request->amount}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Payment Type </b> :<a href="#">  {{$home_service_complete_request->payment_type}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>User Address</b> :<a href="#">  {{$home_service_complete_request->user_address}}</a>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
{{--                    <div class="col-md-4">--}}
{{--                        <!-- Profile Image -->--}}
{{--                        <div class="card card-outline">--}}
{{--                            <div class="card-header  bg-info">--}}
{{--                                <h3 class="card-title">Payment</h3>--}}
{{--                            </div>--}}
{{--                            <div class="card-body box-profile">--}}
{{--                                <h3 class="profile-username text-center"></h3>--}}
{{--                                <p class="text-muted text-center"></p>--}}
{{--                                <ul class="list-group list-group-unbordered mb-3">--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <b>Amount</b>: <a href="#"> {{$home_service_complete_request->amount}}</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <b>Payment Type </b> :<a href="#">  {{$home_service_complete_request->payment_type}}</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="list-group-item">--}}
{{--                                        <b style="font-size: 20px;color:#e72228">E-prescription</b> :<a href="#" style="font-size: 20px"> Download</a>--}}
{{--                                    </li>--}}

{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- /.col -->
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header  bg-info">
                                <h3 class="card-title">Secmo Doctor Section</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label" >Name</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" value="" name="user_id" class="form-control" id="inputName" >
                                        <a href="#">   <input type="test"  readonly name="bank_name" value="{{$home_service_complete_request->secmo_dr->user->name}}" class="form-control" id="inputName"></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <a href="#"> <input type="text" readonly name="mob_bank_name"  value="{{$home_service_complete_request->secmo_dr->user->phone}}" class="form-control" id="inputEmail"></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Designation</label>
                                    <div class="col-sm-10">
                                        <a href="#"> <input type="text" readonly name="mob_bank_name"  value="{{$home_service_complete_request->secmo_dr->designation}}" class="form-control" id="inputEmail"></a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label"> Doctor Status</label>
                                    <div class="col-sm-10">
                                        <a href="#">   <input type="text" readonly name="acc_holder_name" value="{{$home_service_complete_request->secmo_dr_status}}" class="form-control" id="inputName2" > </a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Secmo Doctor Fee</label>
                                    <div class="col-sm-10">
                                        <a href="#"> <input type="text" readonly name="acc_holder_name" value="{{$home_service_complete_request->secmo_dr_amount}}" class="form-control" id="inputName2" ></a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Secmo Address</label>
                                    <div class="col-sm-10">
                                        <a href="#"> <input type="text" readonly name="acc_holder_name" value="{{$home_service_complete_request->secmo_address}}" class="form-control" id="inputName2" ></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
{{--                    <div class="col-md-6">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header  bg-info">--}}
{{--                                <h3 class="card-title">Special Doctor Section</h3>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}

{{--                                    <div class="form-group row">--}}
{{--                                        <label for="inputName" class="col-sm-2 col-form-label" >Name</label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <input type="hidden" value="" name="user_id" class="form-control" id="inputName" >--}}
{{--                                            <a href="#">  <input type="test" readonly  value="{{$home_service_complete_request->SpecialistDr->user->name}}" class="form-control" id="inputName"></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <a href="#">    <input type="text" readonly   value="{{$home_service_complete_request->SpecialistDr->user->phone}}" class="form-control" id="inputEmail"></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label for="inputEmail" class="col-sm-2 col-form-label">Designation</label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <a href="#">  <input type="text" readonly  value="{{$home_service_complete_request->SpecialistDr->designation}}" class="form-control" id="inputEmail"></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                <div class="form-group row">--}}
{{--                                        <label for="inputEmail" class="col-sm-2 col-form-label">Experience</label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <a href="#">  <input type="text" readonly value="{{$home_service_complete_request->SpecialistDr->experience}}" class="form-control" id="inputEmail"></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group row">--}}
{{--                                        <label for="inputName2" class="col-sm-2 col-form-label">Doctor Fee</label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <a href="#">   <input type="text" readonly  value="{{$home_service_complete_request->specialist_dr_amount}}" class="form-control" id="inputName2" ></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                        </div>--}}
{{--                        <!-- /.card -->--}}
{{--                    </div>--}}
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
