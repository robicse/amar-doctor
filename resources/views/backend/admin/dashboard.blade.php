@extends('backend.layouts.master')
@section("title","Dashboard")
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{strtoupper('Admin Dashboard')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$speciality}}</h3>
                            <p>Speciality </p>
                            <br> 
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.speciality.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>{{$special_dr}}</h3>
                            <p>Registered Specialist <br> Doctors</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-md text-info"></i>
                        </div>
                        <a href="{{route('admin.doctor.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$secmo_dr}}</h3>

                            <p>Registered Sacmo <br> Doctors</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-md text-primary"></i>
                        </div>
                        <a href="{{route('admin.secmo.doctor.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$deliveryMan}}</h3>

                            <p>Registered Delivery <br> Man</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-person-booth"></i>
                        </div>
                        <a href="{{route('admin.deliveryMan.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$total_online_drs}}</h3>
                            <p>Online Specialist Doctors</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-md text-info"></i>
                        </div>
                        <a href="{{route('admin.doctor.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$total_online_secmo_drs}}</h3>

                            <p>Online Sacmo Doctors</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-md text-primary"></i>
                        </div>
                        <a href="{{route('admin.secmo.doctor.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark-gradient">
                        <div class="inner">
                            <h3>{{$online_deliveryMan}}</h3>

                            <p>Online Delivery Man</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-person-booth"></i>
                        </div>
                        <a href="{{route('admin.deliveryMan.list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$totalUsers}}</h3>

                            <p>Total User </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{route('admin.customers.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
{{--            </div>--}}
{{--            <div class="row">--}}
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$lab}}</h3>

                            <p>Total Labs</p>
                        </div>
                        <div class="icon">
                            <i class=" fa fa-flask "></i>
                        </div>
                        <a href="{{route('admin.lab.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$sampleCollector}}</h3>

                            <p>Total Sample Collector</p>
                        </div>
                        <div class="icon">
{{--                            <i class="fa fa-battery"></i>--}}
                            <i class="fas fa-capsules"></i>
                        </div>
                        <a href="{{route('admin.lab_sample_collector.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->


                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$offer}}</h3>

                            <p>Total Offer</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <a href="{{route('admin.offers.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$coupon}}</h3>

                            <p>Total Coupon</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-gift"></i>
                        </div>
                        <a href="{{route('admin.coupon.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-dark-gradient">
                        <div class="inner">
                            <h3>{{$blog}}</h3>

                            <p>Total Blog</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-blog"></i>
                        </div>
                        <a href="{{route('admin.blogs.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@stop
