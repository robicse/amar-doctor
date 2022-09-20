@extends('backend.layouts.master')
@section("title","Edit Lab Sample Collector")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Lab Sample Collector</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Lab Sample Collector</li>
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
                        <h3 class="card-title float-left">Edit Lab Sample Collector</h3>
                        <div class="float-right">
                            <a href="{{route('admin.lab_sample_collector.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.lab_sample_collector.update',$sample_collectors ->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Lab Name</label>
                                <select name="lab_id" id="lab_id" class="form-control" required>
                                    <option value="">Select One</option>
                                    @foreach($labs as $lab)
                                        <option value="{{$lab->id}}" {{$lab->id == $sample_collectors->lab_id ? "selected" : " "  }}>{{$lab->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$sample_collectors->name}}" placeholder="Enter Lab Name" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{$sample_collectors->email}}" placeholder="Enter  Email" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{$sample_collectors->address}}" placeholder="Enter Address" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{$sample_collectors->phone}}" placeholder="Enter Phone" required>
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
        CKEDITOR.replace( 'description' );
    </script>
@endpush
