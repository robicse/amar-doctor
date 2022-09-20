<style>
    .count{
        color: #1065a0;
        font-size: 20px;
        font-weight: bold;
    }
    .dropdown-item:focus, .dropdown-item:hover {
        color: #16181b;
        text-decoration: none;
        background-color: #0773bb;
    }
    @media (max-width:575px){
        .mobile_view{
            margin-left: 50px;
        }
    }

</style>

<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a target="_blank" href="{{url('/')}}" class="nav-link"  data-toggle="frontend" data-placement="bottom" data-original-title="Browse Frontend">
                <i class="fas fa-globe"></i>
            </a>
        </li>
        {{--<li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Profile</a>
        </li>--}}
    </ul>

    <!-- SEARCH FORM -->
{{--    <form class="form-inline ml-3">--}}
{{--        <div class="input-group input-group-sm">--}}
{{--            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-navbar" type="submit">--}}
{{--                    <i class="fa fa-search"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{asset('backend/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{asset('backend/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{asset('backend/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
       {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>--}}
        @php


            $new_specialist_doctor = \App\Model\SpecialistDr::where('is_approved',0)->count();
            $new_secmo_doctor = \App\Model\SecmoDr::where('is_approved',0)->count();
            $new_deliveryMan = \App\Model\DeliveryMan::where('is_approved',0)->count();
            $unPublishedOffer = \App\Model\Offer::where('is_publish',0)->count();
            $total =$new_specialist_doctor + $new_secmo_doctor + $new_deliveryMan + $unPublishedOffer + pendingTelemedicineCount()+homeServiceRequestCount()+deliveryManRequestCount()+offerRequestCount()+withdrawRequestCount();
        @endphp
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge"> {{$total}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right mobile_view">
                <span class="dropdown-item dropdown-header">{{$total}} Notifications</span>

                <div class="dropdown-divider"></div>
                    <a href="{{route('admin.telemedicine.pending.request')}}" class="dropdown-item">
                        <i class="fas fa-file-video-o mr-2"></i> <span class="count">{{pendingTelemedicineCount()}}</span>  New Telemedicine Request
                    </a>
                <div class="dropdown-divider"></div>
                    <a href="{{route('admin.pending.request')}}" class="dropdown-item">
                        <i class="fas fa-shopping-cart mr-2"></i> <span class="count"> {{homeServiceRequestCount()}}</span> New Home Service Request
                    </a>
                <div class="dropdown-divider"></div>
                    <a href="{{route('admin.deliveryMan.pending.request')}}" class="dropdown-item">
                        <i class="fas fa-person-booth mr-2"></i><span class="count">{{deliveryManRequestCount()}}</span>  New Delivery Man Request
                    </a>
                <div class="dropdown-divider"></div>
                    <a href="{{route('admin.offer.pending.request')}}" class="dropdown-item">
                        <i class="fa fa-gift mr-2"></i> <span class="count">{{offerRequestCount()}}</span>  New Offer Request
                    </a>
                <div class="dropdown-divider"></div>
                    <a href="{{route('admin.withdraw.pending.request')}}" class="dropdown-item">
                        <i class="fa fa-money mr-2"></i><span class="count">  {{withdrawRequestCount()}}</span> New Withdrawals Request
                    </a>
                <div class="dropdown-divider"></div>
                    <a href="{{route('admin.doctor.list')}}" class="dropdown-item">
                        <i class="fa fa-user-md mr-2"></i> <span class="count"> {{$new_specialist_doctor}}</span> New Specialist Doctor
                    </a>
                <div class="dropdown-divider"></div>
                    <a href="{{route('admin.secmo.doctor.list')}}" class="dropdown-item">
                        <i class="fa fa-user-md  mr-2"></i><span class="count"> {{$new_secmo_doctor}}</span>  New Secmo Doctor
                    </a>
                <div class="dropdown-divider"></div>
                    <a href="{{route('admin.deliveryMan.list')}}" class="dropdown-item">
                        <i class="fas fa-person-booth mr-2"></i><span class="count"> {{$new_deliveryMan}}</span>  New Delivery Man
                    </a>
                <div class="dropdown-divider"></div>
                    <a href="{{route('admin.offers.index')}}" class="dropdown-item">
                        <i class=" fa fa-gift mr-2"></i><span class="count"> {{$unPublishedOffer}}</span>  Unpublished Offer
                    </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user-circle"></i> <strong>{{Auth::user()->name}}</strong>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="image text-center">
                    <img src="{{asset('uploads/profile/default.png')}}" width="60px" height="60px" class="img-circle elevation-2 mt-2" alt="User Image">
                </div>
                <span class="dropdown-item dropdown-header">
                    <strong>{{Auth::user()->name}}</strong><br>
                    <small>{{Auth::user()->created_at->diffForHumans()}}</small>
                </span>
                <div class="dropdown-divider"></div>
                <div class="float-left bg-info">
                    <a href="{{url('admin/profile')}}" class="dropdown-item ">
                        <i class="fa fa-user-circle mr-2"></i> Profile
                    </a>
                </div>
                <div class="float-right bg-danger">
                    <a href="#" class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <div class="dropdown-divider"></div>
            </div>
        </li>
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i--}}
{{--                    class="fa fa-th-large"></i></a>--}}
{{--        </li>--}}
    </ul>
</nav>



