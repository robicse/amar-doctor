@extends('backend.layouts.master')
@section("title","Report Check List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@endpush
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">

@endpush
<style>
    .widget-user-2 .widget-user-desc, .widget-user-2 .widget-user-username {
        margin-left: 0px!important;
    }
</style>
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Report Check List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Report Check List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">

                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('uploads/profile/default.png')}}" alt="User profile picture">

                            </div>
                            <h3 class="profile-username text-center">{{$report_checks->user->name}}</h3>

                            <p class="text-muted text-center">Patient </p>

                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#seller_info" data-toggle="tab">User Infos
                                        Info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#NID" data-toggle="tab">Reports Image  </a></li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="seller_info">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="{{$report_checks->name}}" class="form-control" id="inputName" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="email" value="{{$report_checks->phone}}" class="form-control" id="inputEmail" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="email" value="{{$report_checks->address}}" class="form-control" id="inputEmail" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10">
                                                <input type="email" value="{{$report_checks->status}}" class="form-control" id="inputEmail" readonly>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="NID">
                                    @csrf
                                    <div class="form-group row">
                                    @if(!empty($report_images))
                                        @foreach($report_images as $image)
                                        <div class="col-md-10">

                                            <img src="{{asset('uploads/reportcheck/'.$image)}}" alt="" style="height: 500px; width:500px;margin-bottom: 30px">
                                            <br>
                                            <button class="button">  <a class="" href="{{asset('uploads/reportcheck/'.$image)}}" download> <i class="fa fa-download" aria-hidden="true"></i>download  </a></button>
                                        </div>

                                        @endforeach
                                    @endif
                                    </div>

                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

    </script>
@endpush



