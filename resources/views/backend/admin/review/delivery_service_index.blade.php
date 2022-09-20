@extends('backend.layouts.master')
@section("title","Home Service Review List")
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
                    <h1>Delivery Service Review List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Delivery Service Review List</li>
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
                            <div class="card card-info" style="padding: 20px 40px 40px 40px;">
                                <form role="form" action="{{route('admin.review.homeServicedetails')}}" method="POST" style="padding-left: 250px;">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Ratings</label>
                                            <select name="rating" id="" class="form-control select2">
                                                <option value="5" {{$value == 5 ? 'selected' : ''}}>5</option>
                                                <option value="4" {{$value == 4 ? 'selected' : ''}}>4</option>
                                                <option value="3" {{$value == 3 ? 'selected' : ''}}>3</option>
                                                <option value="2" {{$value == 2 ? 'selected' : ''}}>2</option>
                                                <option value="1" {{$value == 1 ? 'selected' : ''}}>1</option>
                                            </select>
                                        </div>
                                        <div class="col-4" style="margin-top: 30px;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            @if($reviews != null)
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#Id</th>
                                    <th>Patient name</th>
                                    <th>Doctor name</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reviews as $key => $review)
                                    <tr>
                                        <td>{{$key + 1}}
                                            @if($review->viewed == 0)
                                                <span class="right badge badge-danger">New</span>
                                            @endif
                                        </td>
{{--                                        @dd($review->user->name)--}}
                                        <td>{{$review->user->name}}</td>

                                        <td>{{$review->secmo_dr->user->name}}</td>
                                        <td>{{$review->rating}}</td>
                                        <td>
                                            <div class="form-group col-md-2 m-0 pt-2">
                                                <label class="switch">
                                                    <input onchange="update_review_status(this)" value="{{ $review->id }}" {{$review->status == 1? 'checked':''}} type="checkbox" >
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-info waves-effect" href="{{route('admin.review.homeServiceView',$review->id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
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
            $.post('{{ route('admin.review-status.homeServiceUpdate') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
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
