@extends('backend.layouts.master')
@section("title","Users List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Users List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Users Lists</h3>
                        <div class="float-right">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customerInfos as $key => $Info)

                                <tr>
                                    <td>{{$key + 1}}
                                        @if($Info->view == 0)
                                            <span class="right badge badge-danger">New</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$Info->name}}
                                        @if($Info->banned == 1)
                                            <strong class="badge badge-danger">Banned</strong>
                                        @endif
                                    </td>
                                    <td>{{$Info->phone}}</td>
                                    <td>{{$Info->email}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="bg-dark dropdown-item" href="{{route('admin.customers.paitent.show',($Info->id))}}">
                                                    <i class="fa fa-user"></i> Patient List
                                                </a>
                                                <a class="bg-dark dropdown-item" href="{{route('admin.customers.profile.show',($Info->id))}}">
                                                    <i class="fa fa-user"></i> Profile
                                                </a>
                                                <a style="display: none" class="bg-dark dropdown-item" href="{{route('admin.customers.transaction',$Info->id)}}">
                                                    <i class="fa fa-user"></i> Transaction
                                                </a>
                                                {{--                                                <a class="bg-danger dropdown-item" href="{{route('admin.customers.ban',$Info->id)}}">--}}
                                                {{--                                                    <i class="fa fa-ban"></i> Ban this User--}}
                                                {{--                                                </a>--}}
                                                @if($Info->banned != 1)
                                                    <a class=" dropdown-item " href="#" onclick="confirm_ban('{{route('admin.customer.ban', $Info->id)}}');"> Ban this User <i class="fa fa-ban text-danger" aria-hidden="true"></i> </a>
                                                @else
                                                    <a class=" dropdown-item" href="#" onclick="confirm_unban('{{route('admin.customer.ban', $Info->id)}}');"> Unban this User <i class="fa fa-check text-success" aria-hidden="true"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal html start--}}
        {{--        <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
        {{--            <div class="modal-dialog">--}}
        {{--                <div class="modal-content" id="modal-content">--}}

        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </section>
    <div class="modal fade" id="confirm-ban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #0871b8">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>

                <div class="modal-body">
                    <p>Do you really want to ban this User?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a id="confirmation" class="btn btn-danger btn-ok">Proceed!</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-unban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #0871b8">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>

                <div class="modal-body">
                    <h5>Do you really want to unban this User?</h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a id="confirmationunban" class="btn btn-success btn-ok">Proceed!</a>
                </div>
            </div>
        </div>
    </div>


@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>

        function confirm_ban(url)
        {
            $('#confirm-ban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmation').setAttribute('href' , url);
        }

        function confirm_unban(url)
        {
            $('#confirm-unban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmationunban').setAttribute('href' , url);
        }

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



