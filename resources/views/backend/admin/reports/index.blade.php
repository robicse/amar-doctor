@extends('backend.layouts.master')
@section("title","TelemedicineRequest Report List")
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
                    <h1>Telemedicine Report List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Telemedicine Report List</li>
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
                                <form class="form-inline" action="{{route('admin.telemedicine.report')}}" style="margin-bottom: 20px">
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
                                        <a href="{{route('admin.telemedicine.index')}}" class="btn btn-primary" type="button">Reset</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            @if($telemedicines != null && $dateTo != null && $dateFrom !=null )
                                <h1 style="text-align: center">Telemedicine Reports Between  </h1>
                                <h3 style="text-align: center">{{$dateTo}} to {{$dateFrom}}  </h3>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#Id</th>
                                    <th>Total Amount <small>(+vat)</small></th>
                                    <th>Admin Amount</th>
                                    <th>Specialist Doctor Amount</th>
                                    <th>Date</th>

                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sum_total_amount = 0;
                                    $sum_admin_amount = 0;
                                    $sum_specialistDr_amount = 0;
                                    $sum_vat_amount = 0;
                                @endphp
                                    @foreach($telemedicines as $key=>$telemedicine)
                                        @php


                                            $sum_total_amount += ($telemedicine->doctor_fee);
                                            $sum_admin_amount += ($telemedicine->admin_fees);
                                            $sum_specialistDr_amount += ($telemedicine->specialist_dr_amount);
                                            $sum_vat_amount += ($telemedicine->total_vat);


                                        @endphp

                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td><span style="font-size: 20px;">৳</span>{{$telemedicine->grand_total}}</td>
                                            <td><span style="font-size: 20px;">৳</span>{{$telemedicine->admin_fees}}</td>
                                            <td><span style="font-size: 20px;">৳</span>{{$telemedicine->specialist_dr_amount}}</td>
{{--                                            <td>{{$telemedicine->created_at}}</td>--}}
                                            <td>{{ date_format($telemedicine->created_at, 'jS F Y')}} </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                                <div class="tile-footer text-right" style="margin-top: 50px">
                                    <h3><strong><span style="margin-right: 50px;margin-top: 50px">Total Vat: {{$sum_vat_amount}}<span style="font-size: 40px;">৳</span></span></strong></h3>
                                    <h3><strong><span style="margin-right: 50px;margin-top: 50px">Total Amount: {{$sum_total_amount}}<span style="font-size: 40px;">৳</span></span></strong></h3>
                                    <h3><strong><span style="margin-right: 50px;">Total Admin Amount: {{$sum_admin_amount}}<span style="font-size: 40px;">৳</span></span></strong></h3>
                                    <h3><strong><span style="margin-right: 50px;">Total Specialist Doctor Amount: {{$sum_specialistDr_amount}}<span style="font-size: 40px;">৳</span></span></strong></h3>
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
