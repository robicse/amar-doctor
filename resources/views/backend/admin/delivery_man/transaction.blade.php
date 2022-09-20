@extends('backend.layouts.master')
@section("title","Delivery Man Transaction History")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <style>
        .card-body {
            flex: 1 1 auto;
            padding: 0!important;
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Delivery Man Transaction History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Delivery Man Transaction History</li>
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
                        <h3 class="card-title float-left">Delivery Man Transaction History</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>

                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Remaining Balance</th>
                                <th>Details</th>
                                <th>Date</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($delivery_mans as $key => $delivery_man)
                                <tr>
                                    <td>{{$delivery_man->trx}}</td>
                                    <td>{{$delivery_man->trx_type}}{{$delivery_man->amount}}</td>
                                    <td><span style="font-size: 20px;">৳</span>{{$delivery_man->post_balance}}</td>
                                    <td>{{$delivery_man->details}}</td>
                                    <td>{{ date_format($delivery_man->created_at, 'jS F Y')}} </td>


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
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >×</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>

                <div class="modal-body">
                    <p>Do you really want to ban this Doctor?</p>
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
                    <h5>Do you really want to unban this Doctor?</h5>
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
            $.post('{{ route('admin.doctor.is_approved') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
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
            $.post('{{ route('admin.doctor.is_active') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
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

