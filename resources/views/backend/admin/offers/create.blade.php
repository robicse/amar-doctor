@extends('backend.layouts.master')
@section("title","Add Offers")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Offers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add Offers</li>
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
                        <h3 class="card-title float-left">Add Offers</h3>
                        <div class="float-right">
                            <a href="{{route('admin.sliders.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.offers.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="offer_title" id="offer_title" placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Speciality</label>
                                <select name="specialty_id" id="value" class="form-control" required>
                                    @foreach($speciality as $special)
                                    <option value="{{$special->id}}">{{$special->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Offer Cost</label>
                                <input type="text" class="form-control" name="offer_cost" id="offer_cost" placeholder="Enter Title" required>
                            </div>
                             <div class="form-group">
                                <label for="title">Description</label>

                                 <textarea name="short_description" id="description"  class="form-control"></textarea>
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
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endpush
