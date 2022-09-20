@extends('backend.layouts.master')
@section("title"," Doctor Details")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Doctor Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Doctor Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-10 offset-1">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Doctor Details</h3>
                        <div class="float-right">
                            <a href="{{route('admin.lab_test_request')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.doctor.update',$doctors ->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
{{--                        @method('PUT')--}}
                        <div class="card-body">
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Doctor Name</label>
                                    <input type="text" class="form-control" name="name" id="address" value="{{$doctors->user->name}}" placeholder="Enter " required>
                                    <input type="hidden" class="form-control" name="user_id" id="address" value="{{$doctors->user_id}}" placeholder="Enter " >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">Designation</label>
                                    <input type="text" class="form-control" name="designation" id="designation" value="{{$doctors->designation}}" placeholder="Enter " >
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{$doctors->user->address}}" placeholder="Enter Address">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="address" value="{{$doctors->user->phone}}" placeholder="Enter phone number" >
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Professional Degree</label>
                                    <input type="text" class="form-control" name="professional_derees" id="professional_derees" value="{{$doctors->professional_derees}}" placeholder="Enter ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">BMDC</label>
                                    <input type="text" class="form-control" name="bmdc" id="bmdc" value="{{$doctors->bmdc}}" placeholder="Enter " >
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Professional Degree</label>
                                    <input type="text" class="form-control" name="professional_derees" id="professional_derees" value="{{$doctors->professional_derees}}" placeholder="Enter ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">BMDC</label>
                                    <input type="text" class="form-control" name="bmdc" id="bmdc" value="{{$doctors->bmdc}}" placeholder="Enter " >
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Experience</label>
                                    <input type="text" class="form-control" name="experience" id="experience" value="{{$doctors->experience}}" placeholder="Enter ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">Doctor Code</label>
                                    <input type="text" class="form-control" name="doctor_code" id="doctor_code" value="{{$doctors->doctor_code}}" placeholder="Enter " >
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Consultation Fee</label>
                                    <input type="text" class="form-control" name="consultation_fee" id="consultation_fee" value="{{$doctors->consultation_fee}}" placeholder="Enter ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">Follow Up Fee</label>
                                    <input type="text" class="form-control" name="follow_up_fee" id="follow_up_fee" value="{{$doctors->follow_up_fee}}" placeholder="Enter " >
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Availability</label>
                                    <input type="text" class="form-control" name="availability" id="availability" value="{{$doctors->availability}}" placeholder="Enter ">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">Consultation Time</label>
                                    <input type="text" class="form-control" name="consultation_time" id="consultation_time" value="{{$doctors->consultation_time}}" placeholder="Enter " >
                                </div>
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
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'details' );
    </script>
@endpush
