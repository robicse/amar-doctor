@extends('backend.layouts.master')
@section("title","Delivery Man Report List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <style>
        table.dataTable tbody th, table.dataTable tbody td {
            padding: 0px 6px!important;
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Delivery Man Report List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Delivery Man Report List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="callout callout-info">
                        <div class=" card-info" style="padding: 20px 40px 40px 40px;">
                            <form class="form-inline" action="{{route('admin.deliveryMAn.report')}}" style="margin-bottom: 20px">
                                <div class="form-group col-md-4">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="dateFrom" class="form-control" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="dateTo" class="form-control" >
                                </div>
                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-success">Advanced Search</button>
                                    <a href="{{route('admin.deliveryMAn.index')}}" class="btn btn-primary" type="button">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        @if($deliveryMans != null && $dateTo != null && $dateFrom !=null )
                            <h1 style="text-align: center">Delivery Reports Between  </h1>
                            <h3 style="text-align: center">{{$dateTo}} to {{$dateFrom}}  </h3>

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#Id</th>
                                    <th>Total Amount</th>
                                    <th>Admin Amount</th>
                                    <th>Delivery Man Amount</th>
                                    <th>Date</th>

                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sum_total_amount = 0;
                                    $sum_admin_amount = 0;
                                    $sum_specialistDr_amount = 0;
                                @endphp
                                @foreach($deliveryMans as $key=>$deliveryMan)
                                    @php
                                        $sum_total_amount += ($deliveryMan->delivery_charge);
                                        $sum_admin_amount += ($deliveryMan->admin_fees);
                                        $sum_specialistDr_amount += ($deliveryMan->delivery_man_cost);
                                    @endphp

                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td><span style="font-size: 20px;">৳</span>{{$deliveryMan->delivery_charge}}</td>
                                        <td><span style="font-size: 20px;">৳</span>{{$deliveryMan->admin_fees}}</td>
                                        <td><span style="font-size: 20px;">৳</span>{{$deliveryMan->delivery_man_cost}}</td>
{{--                                        <td>{{$deliveryMan->created_at}}</td>--}}
                                        <td>{{ date_format($deliveryMan->created_at, 'jS F Y')}} </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="tile-footer text-right" style="margin-top: 50px">
                                <h3><strong><span style="margin-right: 50px;margin-top: 50px">Total Amount: {{$sum_total_amount}}<span style="font-size: 40px;">৳</span></span></strong></h3>
                                <h3><strong><span style="margin-right: 50px;">Total Admin Amount: {{$sum_admin_amount}}<span style="font-size: 40px;">৳</span></span></strong></h3>
                                <h3><strong><span style="margin-right: 50px;">Total Secmo Doctor Amount: {{$sum_specialistDr_amount}}<span style="font-size: 40px;">৳</span></span></strong></3>
                            </div>
                        @endif

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
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
        $('.select2').select2();
        //update status
        function update_review_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.review-status.update') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Status updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
