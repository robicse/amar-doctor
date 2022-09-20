@extends('backend.layouts.master')
@section("title","Show Offers")
@push('css')
    <style>
        .widget-user-2 .widget-user-desc, .widget-user-2 .widget-user-username {
            margin-left: 0px !important;
        }

        @import url(https://fonts.googleapis.com/css?family=Open+Sans);

        body {
            background: #f2f2f2;
            font-family: 'Open Sans', sans-serif;
        }

        .search {
            width: 100%;
            position: relative;
            display: flex;
        }

        .searchTerm {
            width: 100%;
            border: 3px solid #00B4CC;
            border-right: none;
            padding: 5px;
            height: 37px;
            border-radius: 5px 0 0 5px;
            outline: none;
            color: #9DBFAF;
        }

        .searchTerm:focus {
            color: #00B4CC;
        }

        .searchButton {
            width: 40px;
            height: 36px;
            border: 1px solid #00B4CC;
            background: #00B4CC;
            text-align: center;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 20px;
        }

        /*Resize the wrap to see the search bar change!*/
        .wrap {
            width: 50%;
            position: absolute;
            left: 50%;
            margin: 20px 20px;
            transform: translate(-50%, -50%);
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Show Offers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Show Offers</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Show Offers</h3>
                        <div class="float-right">
                            <a href="{{route('admin.sliders.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- form start -->
                    @csrf
                    <div class="card-body" id="offer_doctors">
                        <div class="doctor-search">
                            <form class="" id="searchSubmit">
                                <div class="search">
                                    <input type="hidden" value="{{$offer->id}}" id="offerIdInSearch">
                                    <input id="searchMain" type="text" class="searchTerm"
                                           placeholder="Search By Doctor Name?">
                                    <button type="submit" class="searchButton mr-2">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <a href="" class="btn btn-success"> <i class="fa fa-refresh"></i></a>
                                </div>
                            </form>
                        </div>
                        <div class="search-result" id="search-result">
                            <form role="form" action="{{route('admin.drOfferStore')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <h3>Offer for Doctor</h3>
                                    <div class="wrap">

                                    </div>
                                    <!-- SEARCH FORM -->

                                    <p class="bg-info pl-3">
                                        <input type="hidden" name="dr_offers_id" value="{{$offer->id}}">
                                        <input type="checkbox" id="checkAll"> By a click you can select all
                                    </p>
                                    <ul class="list-group" style="height: 415px; overflow-y: scroll;" >
                                        @foreach($specialist_drs as $dr)
                                            <li class="list-group-item m-0 mr-2 mb-1">
                                                <label for="" class="m-0 p-0">
                                                    <input type="checkbox" class="checkbox" name="specialist_dr_id[]"
                                                           id="specialist_dr_id"
                                                           value="{{$dr->id}}" {{ in_array($dr->id, $drOffers) ? 'checked' : '' }} > {{$dr->title.' '.$dr->name}}
                                                    <span class="badge badge-primary">  {{$dr->bmdc}} </span> <span
                                                        class="badge badge-primary">  {{$dr->phone}} </span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <!-- Widget: user widget style 2 -->
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h4 class="widget-user-desc text-uppercase text-left">Offers</h4>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <ba>Title:</ba> {{$offer->offer_title}}
                                </a>
                            </li>
                            @php
                                foreach ($speciality as $special )
   // dd($special->name);
                            @endphp
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Specialist:
                                    {{$offer->speciality->name}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Cost :{{$offer->offer_cost}} Taka
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Published
                                    :{{$offer->is_publish == 1 ? "This offer is currently Published" : "This offer is currently not Published"}}
                                </a>
                            </li>
                            {{--                            <li class="nav-item">--}}
                            {{--                                <a href="#" class="nav-link">--}}
                            {{--                                    Description : {!! $offer->short_description !!}--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}


                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
    </section>

@stop
@push('js')

    <script>
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#searchSubmit").submit(function(event) {
            event.preventDefault();
            var q = $('#searchMain').val();
            var offerId = $('#offerIdInSearch').val();
            //alert(offerId)
            if (q !== "") {
                $.post('{{route('admin.offers.search.doctors')}}', {
                    _token: '{{ csrf_token() }}',
                    q: q,
                    offerId: offerId,
                }, function (data) {
                    console.log(data)
                    $('#search-result').empty();
                    $('#search-result').html(data);
                });
            }
        })

        function offerAddDelete(drId){
            var offerId = $('#offerId').val();
            //alert(offerId)
            if($('.dr_checkbox-'+drId).is(":checked")){
               //alert('checked')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{url('/admin/offers/single/doctor/insert')}}",
                    type: 'POST',
                    data: {"offerId": offerId, "drId": drId },
                    success: function(data) {
                        if (data == 1){
                            toastr.success('Data Updated Successfully');
                        }else {
                            toastr.error('Something went wrong!!');
                        }
                    }
                });
            }else{
                //alert('unchecked')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{url('/admin/offers/single/doctor/delete')}}",
                    type: 'POST',
                    data: {"offerId": offerId, "drId": drId },
                    success: function(data) {
                        if (data == 1){
                            toastr.success('Data Updated Successfully');
                        }else {
                            toastr.error('Something went wrong!!');
                        }
                    }
                });
            }
        }
    </script>
@endpush
