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
                    <div class="col-md-4">
                        <!-- Profile Image -->
                        <div class="card  card-outline">
                            <div class="card-header  bg-info">
                                <h3 class="card-title">About Patient</h3>
                            </div>
                            <div class="card-body box-profile">

                                <div class="text-center">
                                    @if(!empty($offers_show_request->patient->photo))
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="{{url($offers_show_request->patient->photo)}}" alt="User profile picture">
                                    @else
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="{{asset('uploads/profile/default.png')}}" alt="User profile picture">
                                    @endif
                                </div>

                                <h3 class="profile-username text-center"></h3>

                                <p class="text-muted text-center"></p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Name</b>: <a href="#"> {{$offers_show_request->patient->name}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gender </b> :<a href="#"> {{$offers_show_request->patient->gender}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Age</b> :<a href="#"> {{$offers_show_request->patient->age_year}}.{{$offers_show_request->patient->age_month}} year</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Weight</b> :<a href="#"> {{$offers_show_request->patient->weight}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Relationship With User :</b> <a href="#">   {{$offers_show_request->patient->relationship}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Marital Status :</b> <a href="#">   {{$offers_show_request->patient->marital_status}}</a>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <div class="col-md-4">
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
                                        <b>Name</b>: <a href="#"> {{$offers_show_request->user->name}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Address </b> :<a href="#">  {{$offers_show_request->user->address}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email</b> :<a href="#">   {{$offers_show_request->user->email}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone #</b> :<a href="#">   {{$offers_show_request->user->phone}}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <div class="col-md-4">
                        <!-- Profile Image -->
                        <div class="card card-outline">
                            <div class="card-header  bg-info">
                                <h3 class="card-title">Offers</h3>
                            </div>
                            <div class="card-body box-profile">
                                <h3 class="profile-username text-center"></h3>
                                <p class="text-muted text-center"></p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Title</b>: <a href="#"> {{$offers_show_request->offer->offer_title}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Cost</b>: <a href="#"> {{$offers_show_request->offer->offer_cost}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b> Published :</b> <a href="#"> {{$offers_show_request->offer->is_publish == 1 ? "This offer is currently Published" : "This offer is currently not Published"}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b> Offer Status :</b> <a href="#"> {{$offers_show_request->status  }}</a>
                                    </li>

                                    <li class="list-group-item">
                                        <b style="font-size: 20px;color:#e72228">E-prescription</b> :<a href="#" style="font-size: 20px"> Download</a>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class=" offset-md-4 col-md-8" style="margin-top: -100px">
                        <div class="card">
                            <div class="card-header  bg-info">
                                <h3 class="card-title">Special Doctor Section</h3>
                            </div>
                            <div class="card-body">

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label" >Name</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" value="" name="user_id" class="form-control" id="inputName" >
                                            <a href="#">  <input type="test" readonly  value="{{$offers_show_request->SpecialistDr->user->name}}" class="form-control" id="inputName"></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <a href="#">    <input type="text" readonly   value="{{$offers_show_request->SpecialistDr->user->phone}}" class="form-control" id="inputEmail"></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Designation</label>
                                        <div class="col-sm-10">
                                            <a href="#">  <input type="text" readonly  value="{{$offers_show_request->SpecialistDr->designation}}" class="form-control" id="inputEmail"></a>
                                        </div>
                                    </div>
                                <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Experience</label>
                                        <div class="col-sm-10">
                                            <a href="#">  <input type="text" readonly value="{{$offers_show_request->SpecialistDr->experience}}" class="form-control" id="inputEmail"></a>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Doctor Fee</label>
                                        <div class="col-sm-10">
                                            <a href="#">   <input type="text" readonly  value="{{$offers_show_request->specialist_dr_amount}}" class="form-control" id="inputName2" ></a>
                                        </div>
                                    </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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
