@extends('backend.layouts.master')
@section("title","Patient Details ")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Patient Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Patient Details </li>
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
                        <h3 class="card-title float-left">Patient Details </h3>
                        <div class="float-right">
                            <a href="{{route('admin.patient.list')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.patient.update',$patients ->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
{{--                        @method('PUT')--}}
                        <div class="card-body">
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title"> Name</label>
                                    <input type="text" class="form-control" name="name" id="address" value="{{$patients->name}}" placeholder="Enter Address" required>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="title">Gender</label>
                                    <input type="text" class="form-control" name="gender" id="gender" value="{{$patients->gender}}" placeholder="Enter">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title">Relationship </label>
                                    <input type="text" class="form-control" name="relationship" id="relationship" value="{{$patients->relationship}}" placeholder="Enter" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title">Marital Status</label>
                                    <input type="text" class="form-control" name="marital_status" id="marital_status" value="{{$patients->marital_status}}" placeholder="Enter" >
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="title">Age Year</label>
                                    <input type="text" class="form-control" name="age_year" id="age_year" value="{{$patients->age_year}}" placeholder="Enter" >
                                </div>
                              <div class="form-group col-md-4">
                                    <label for="title">Age Month</label>
                                    <input type="text" class="form-control" name="age_month" id="age_month" value="{{$patients->age_month}}" placeholder="Enter">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title">Weight</label>
                                    <input type="text" class="form-control" name="weight" id="weight" value="{{$patients->weight}}" placeholder="Enter ">
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
