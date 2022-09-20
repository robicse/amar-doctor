@extends('backend.layouts.master')
@section("title","Edit Speciality")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Speciality</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Speciality</li>
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
                        <h3 class="card-title float-left">Edit Speciality</h3>
                        <div class="float-right">
                            <a href="{{route('admin.speciality.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.speciality.update',$speciality->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" name="name" id="title" placeholder="Enter Blog Title" value="{{$speciality->name}}" required>
                            </div>
                            <div class="form-group">
                                <img src="{{asset('uploads/special/'.$speciality->icon)}}" alt="" width="80" height="60">
                                <label for="image">Speciality Icon</label>
                                <input type="file" class="form-control" name="image" id="image" >
                            </div>
                            <div class="form-group">
                                <label for="image">Description;</label>
                                <br>
                                <textarea name="description" id="description" rows="3" class="form-control">{!! $speciality->description !!}</textarea>
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

@endpush
