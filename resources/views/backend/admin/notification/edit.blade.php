@extends('backend.layouts.master')
@section("title","Edit Notification")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Notification</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Notification</li>
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
                        <h3 class="card-title float-left">Edit Notification</h3>
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
                    <form role="form" action="{{route('admin.notification.update',$notifications->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <label>Type <small class="text-info"> </small></label>
                            <div class="input-group">
                                <select name="type" id="type"  class="form-control" required>
                                    <option value="secmoDr" {{$notifications->type == 'secmoDr' ? "selected" : ''}}>Secmo Doctor</option>
                                    <option value="specialistDr" {{$notifications->type == 'specialistDr' ? "selected" : ''}}>Specialist Doctor</option>
                                    <option value="deliveryMan" {{$notifications->type == 'deliveryMan' ? "selected" : ''}}>Delivery Man</option>
                                </select>
                            </div>
                            <div class="input-group-appen" style="width: 100%;margin-top: 20px">
                                <textarea name="text" id="" class="form-control value">{!! $notifications->text !!}</textarea>
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
