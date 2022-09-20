@extends('backend.layouts.master')
@section("title","Create Notification")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Notification</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create Notification</li>
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
                        <h3 class="card-title float-left">Create Notification</h3>
                        <div class="float-right">
                            <a href="{{route('admin.notification.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.notification.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <label>Type <small class="text-info"> </small></label>
                            <div class="input-group">
                                <select name="type" id="type"  class="form-control" required>
                                    <option value="">Choose One</option>
                                    <option value="user">User</option>
                                    <option value="specialistDr">Specialist Doctor</option>
                                    <option value="secmoDr">Secmo Doctor</option>
                                    <option value="deliveryMan">Delivery Man</option>
                                </select>
                            </div>
                            <div class="input-group-appen" style="width: 100%;margin-top: 20px">
                                <textarea name="text" id="" class="form-control value"></textarea>
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


    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'text', {
            filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endpush
