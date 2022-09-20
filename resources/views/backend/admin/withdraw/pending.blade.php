@extends('backend.layouts.master')
@section("title","Withdrawals Pending List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Pending List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"> Pending List</li>
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
                        <h3 class="card-title float-left"> Pending List</h3>
                        <div class="float-right">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Date</th>
                                <th>Trx Number</th>
                                <th>Type</th>
                                <th>User Name</th>
                                <th>Charge</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($withdraw_pending_request as $key => $pending)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{ \Carbon\Carbon::parse($pending->created_at)->isoFormat('MMM Do ,YYYY')}}</td>
                                    <td>{{$pending->trx}}</td>
                                    <td>
                                        @if($pending->user->user_type =='specialist_dr')
                                            Specialist Doctor
                                        @elseif($pending->user->user_type =='secmo_dr')
                                            Secmo Doctor
                                        @else
                                            Delivery Man
                                        @endif
                                    </td>

                                    <td>{{$pending->user->name}}</td>
                                    <td><span style="font-size: 20px;">৳</span>{{$pending->charge}}</td>
                                    <td><span style="font-size: 20px;">৳</span>{{$pending->final_amount}}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="bg-dark dropdown-item" data-toggle="modal" data-target="#exampleModal" onclick="show_details_modal('{{$pending->id}}');">
                                                    <i class="fas fa-eye"></i> Details
                                                </a>
                                                <a class="bg-dark dropdown-item"  onclick="changeStatus('{{$pending->id}}');" >
                                                    Status
                                                </a>

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
    <!-- Modal -->
    <div class="modal fade" id="withdrawals_details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>


    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.withdrawals.status')}}" method="post">
                        @csrf
                        <div type="hidden" class="form-group">
                            <input type="hidden" id="tablId">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Status:</label>
                            <select class="form-control" id="" name="status">
                                <option value="complete">Complete</option>
                                <option value="reject">Reject</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Feedback:</label>
                            <textarea class="form-control" name="admin_feedback" rows="3" id="message-text"></textarea>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary">Send message</button>
                        </div>
                    </form>
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
        function show_details_modal(id){
            $.post('{{ route('admin.withdrawals_modal.details') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#withdrawals_details #modal-content').html(data);
                $('#withdrawals_details').modal('show', {backdrop: 'static'});
            });
        }
        function changeStatus(id){
            $('#statusModal').modal('show');
            var idInput = ` <input type="text" name="id" value="${id}">`
            $('#tablId').html(idInput)

        }
    </script>
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

    </script>
@endpush
