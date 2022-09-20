@extends('backend.layouts.master')
@section("title","Details Lab Test Request")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Details Lab Test Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Details Lab Test Request</li>
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
                        <h3 class="card-title float-left">Details Lab Test Request</h3>
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
                    <form role="form" action="{{route('admin.lab_test_request.update',$last_test_request ->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
{{--                        @method('PUT')--}}
                        <div class="card-body">
                            <div class="row col-md-12">
                                <div class="form-group col-md-12">
                                    <label for="title">Patient First Name</label>
                                    <input type="text" class="form-control" name="f_name" id="address" value="{{$last_test_request->name}}" placeholder="Enter Address" required>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{$last_test_request->address}}" placeholder="Enter Address">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="address" value="{{$last_test_request->phone}}" placeholder="Enter phone number" >
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Test amount</label>
                                    <input type="text" class="form-control" name="test_amount" id="address" value="{{$last_test_request->test_amount}}" placeholder="Enter Amount" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{$last_test_request->status == 'pending'? 'selected' : ''}}>Pending</option>
                                        <option value="processing" {{$last_test_request->status == 'processing'? 'selected' : ''}}>Processing</option>
                                        <option value="ongoing" {{$last_test_request->status == 'ongoing'? 'selected' : ''}}>Ongoing</option>
                                        <option value="collected" {{$last_test_request->status == 'collected'? 'selected' : ''}}>Collected</option>
                                        <option value="completed" {{$last_test_request->status == 'completed'? 'selected' : ''}}>Completed</option>

                                    </select>
                                </div>
                                @php
                               // $test_photo = array();
                                $last_tests= json_decode($last_test_request->test_photo);
                                //dd($last_tests);
                                @endphp

                            </div>
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="title">Lab Name</label>
                                    <select name="lab_id" id="lab_id" class="form-control demo-select2">
                                        <option value="">Select One</option>
                                        @foreach($labs as $lab)
                                          <option value="{{$lab->id}}" {{$last_test_request->lab_id == $lab->id ? 'selected' : ''}}>{{$lab->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="title">Sample Collector Name</label>
                                    <select name="lab_sample_collectors_id" id="lab_sample_collectors_id" class="form-control demo-select2">
                                        <option value="">Select One</option>
                                        @foreach($lab_sample_collector as $collector)
                                            <option value="{{$collector->id}}" {{$last_test_request->lab_sample_collectors_id == $collector->id ? 'selected' : ''}}>{{$collector->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class=" col-md-12">
                                <label for="title">Photo</label>
                                <br>
                                @foreach ($last_tests as $key => $photo)
                                    <a class="" href="{{asset('uploads/test_photo/'.$photo)}}" download> <img src="{{asset('uploads/test_photo/'.$photo)}}" alt="" width="80" height="80"></a>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="title">Details</label>
                                <input type="text" class="form-control" name="investigation_chart" id="investigation_chart" value="{{$last_test_request->investigation_chart}}" placeholder="Enter Investigation Chart" >
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
