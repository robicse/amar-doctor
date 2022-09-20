@extends('backend.layouts.master')
@section("title","Delivery Man Profile")
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
                    <h1>Delivery Man Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Delivery Man Profile</li>
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
                                @if(!empty($delivery_mans->avatar_original))
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{url($delivery_mans->avatar_original)}}" alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('uploads/profile/default.png')}}" alt="User profile picture">
                                @endif
                            </div>
                            @if($delivery_mans->is_online == 1)
                                <div class="text-center m-1">
                                    <span class="badge badge-success">Online</span>
                                </div>
                            @else
                                <div class="text-center m-1">
                                    <span class="badge badge-secondary">Offline</span>
                                </div>
                            @endif
                            <h3 class="profile-username text-center">{{$delivery_mans->user->name}}</h3>

                            <p class="text-muted text-center">Delivery Man </p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Admin Will Pay</b> <a class="float-right">@if(!empty($delivery_man->admin_will_pay))<span style="font-size: 20px;">৳</span>{{$delivery_mans->admin_will_pay}}@endif</a>
                                    </li>
                                </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#seller_info" data-toggle="tab">Delivery Man
                                        Info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">Edit
                                        Profile </a></li>
                                <li class="nav-item"><a class="nav-link" href="#NID" data-toggle="tab">NID </a></li>
                                <li class="nav-item"><a class="nav-link" href="#change_pass" data-toggle="tab">Change Password</a></li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="seller_info">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" value="{{$delivery_mans->user->name}}" class="form-control" id="inputName" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="email" value="{{$delivery_mans->user->phone}}" class="form-control" id="inputEmail" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" value="{{$delivery_mans->user->email}}" class="form-control" id="inputEmail" readonly>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="edit">
                                    <form class="form-horizontal" action="{{route('admin.deliveryMan.profile.update',$delivery_mans->id)}}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">

                                                <input type="text" value="{{$delivery_mans->user->name}}" name="name" class="form-control" id="inputName" >
                                                <input type="hidden" value="{{$delivery_mans->user_id}}" name="user_id" class="form-control" id="inputName" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="number" value="{{$delivery_mans->user->phone}}" name="phone" class="form-control" id="inputEmail" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" value="{{$delivery_mans->user->email}}" name="email" class="form-control" id="inputEmail" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="NID">
                                    @csrf
                                    <div class="form-group row">

                                        <label for="inputName" class="col-sm-2 col-form-label">NID Front Image</label>
                                        <br>
                                        <div class="col-sm-10">
                                            <img src="{{asset('uploads/nid/'.$delivery_mans->user->nid_pp_front)}}" alt="" style="height: 300px; width: 300px">
                                        </div>
                                        <button class="button"> <a class="" href="{{asset('uploads/nid/'.$delivery_mans->user->nid_pp_front)}}" download> <i class="fa fa-download" aria-hidden="true"></i>download  </a></button>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">NID Back Image</label>
                                        <br>
                                        <div class="col-sm-10">
                                            <img src="{{asset('uploads/nid/'.$delivery_mans->user->nid_pp_back)}}" alt="" style="height: 300px; width: 300px">
                                        </div>
                                        <button class="button"> <a class="" href="{{asset('uploads/nid/'.$delivery_mans->user->nid_pp_front)}}" download> <i class="fa fa-download" aria-hidden="true"></i>download  </a></button>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="change_pass">
                                    <form class="form-horizontal" action="{{route('admin.deliveryMan.password.update',$delivery_mans->id)}}" method="POST">
                                        @csrf
{{--                                        @method('PUT')--}}
                                        <div class="form-group row">
                                            <input type="hidden" value="{{$delivery_mans->user->id}}" name="user_id" class="form-control" id="inputName" >
                                            <label for="inputName" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" class="form-control" id="inputName">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password_confirmation" class="form-control" id="inputEmail">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <div class="card">
                        <div class="card-header  p-2 p-0 bg-info">
                            <strong>Bank Details</strong>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="" method="POST">
                                @csrf
                                @if(!empty($delivery_mans->bank_name))
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Bank Name</label>
                                    <div class="col-sm-10">
                                        <input type="hidden" value="{{$delivery_mans->user_id}}" name="user_id" class="form-control" id="inputName">
                                        <input type="test" name="bank_name" value="{{$delivery_mans->bank_name}}" class="form-control" id="inputName" readonly>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($delivery_mans->acc_holder_name))
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Bank Holder Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="mob_bank_name"  value="{{$delivery_mans->acc_holder_name}}" class="form-control" id="inputEmail" readonly>
                                    </div>
                                @endif
                                @if(!empty($delivery_mans->account_number))
                                <div class="form-group row">
                                    <label for="bank_acc_no" class="col-sm-4 col-form-label">Bank Acc Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="account_number" value="{{$delivery_mans->account_number}}" class="form-control" id="bank_acc_no" readonly>
                                    </div>
                                </div>
                                @endif
                                @if(!empty($delivery_mans->mob_bank_name))
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Mobile Bank Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="acc_holder_name" value="{{$delivery_mans->mob_bank_name}}" class="form-control" id="inputName2"  readonly>
                                    </div>
                                @endif

                                @if(!empty($delivery_mans->mob_bank_number))
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-4 col-form-label">Mobile Bank Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="mob_bank_name" value="{{$delivery_mans->mob_bank_number}}" class="form-control" id="inputName2" readonly >
                                    </div>
                                </div>
                                @endif
                            </form>
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
@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
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



