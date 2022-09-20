@extends('backend.layouts.master')
@section("title","Delivery Man List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Delivery Man List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Delivery Man List</li>
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
                        <h3 class="card-title float-left">Delivery Man List</h3>
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
                                <th>Admin will pay</th>
                                <th>Is Approved</th>
                                <th>Is Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($delivery_mans as $key => $delivery_man)
                                <tr>
                                    <td>{{$key + 1}}
                                        @if($delivery_man->user->view == 0)
                                            <span class="right badge badge-danger">New</span>
                                        @endif
                                    </td>
                                    <td>@if($delivery_man->user->banned == 1) <i class="fa fa-ban text-danger" aria-hidden="true"></i> @endif {{$delivery_man->user->name}}</td>

                                    <td>{{$delivery_man->user->phone}}</td>
                                    <td>@if(!empty($delivery_man->admin_will_pay))<span style="font-size: 20px;">৳</span>{{$delivery_man->admin_will_pay}}@endif</td>
                                    <td>

                                        <div class="form-group col-md-2 m-0 pt-2">
                                            <label class="switch">

                                                <input onchange="update_approved(this)" value="{{ $delivery_man->id }}" {{$delivery_man->is_approved == 1 ? 'checked':''}} type="checkbox" >
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>

                                        <div class="form-group col-md-2 m-0 pt-2">
                                            <label class="switch">

                                                <input onchange="update_active(this)" value="{{ $delivery_man->id }}" {{$delivery_man->is_active == 1 ? 'checked':''}} type="checkbox" >
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="bg-dark dropdown-item" href="{{route('admin.deliveryMan.show',$delivery_man->id)}}">
                                                    <i class="fa fa-user"></i> Profile
                                                </a>
                                                <a class="bg-dark dropdown-item" href="{{route('admin.deliveryMan.transaction',$delivery_man->user_id)}}">
                                                    <i class="fa fa-user"></i> Transaction
                                                </a>

                                            @if($delivery_man->user->banned != 1)
                                                <a class=" dropdown-item " href="#" onclick="confirm_ban('{{route('admin.deliveryMan.ban', $delivery_man->id)}}');"> Ban this Delivery Man <i class="fa fa-ban text-danger" aria-hidden="true"></i> </a>
                                                @else
                                                    <a class=" dropdown-item" href="#" onclick="confirm_unban('{{route('admin.deliveryMan.ban', $delivery_man->id)}}');"> Unban this Delivery Man <i class="fa fa-check text-success" aria-hidden="true"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>



    <div class="modal fade" id="confirm-ban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header" style="background-color: #0871b8">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>

                <div class="modal-body">
                    <p>Do you really want to ban this Delivery Man?</p>
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
                    <h5>Do you really want to unban this Delivery Man?</h5>
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

        //sweet alert
        function deleteCategory(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
        //Is Approved
        function update_approved(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.deliveryMan.is_approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Is Approved updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
        //Is Active
        function update_active(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.deliveryMan.is_active') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Is Active updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
