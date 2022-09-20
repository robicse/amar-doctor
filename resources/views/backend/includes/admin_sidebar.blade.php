<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: #303641;  min-height: 600px!important;">
    <!-- Brand Logo -->
{{--<a href="#" class="brand-link">
    <img src="{{asset('backend/images/logo.png')}}" width="150" height="100" alt="Aamar Bazar" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    --}}{{--<span class="brand-text font-weight-light">Farazi Home Care</span>--}}{{--
</a>--}}
<!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-2 pl-2 mb-2 d-flex elevation-4" >
            <div class="">
                {{--<h2 class="text-info text-bold p-0 m-0">Doctor Pathao</h2>--}}
                <img src="{{asset('/backend/images/pathao.png')}}" class="" alt="User Image" style="width: 50%;">
            </div>
        </div>

    @if (Auth::check()  && (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff')  )
        <!-- Sidebar Menu -->
            <nav class="mt-1">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('admin.dashboard')}}"
                           class="nav-link {{Request::is('admin/dashboard') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    <li class="nav-item has-treeview {{(Request::is('admin/telemedicine*')) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-video-o"></i>
                            <p>
                               Telemedicine
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.telemedicine.pending.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/telemedicine/pending_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Pending Request  <span class="badge badge-primary"> {{pendingTelemedicineCount()}}</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.telemedicine.processing.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/telemedicine/processing_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Processing Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.telemedicine.complete.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/telemedicine/complete_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Complete Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.telemedicine.cancle.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/telemedicine/cancle_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Cancle Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.medicine_list.index')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/medicine_list/index/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Medicine List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{(Request::is('admin/home*')) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                H.Serv. Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.pending.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/home/pending_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Pending Request   <span class="badge badge-primary"> {{homeServiceRequestCount()}}</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.processing.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/home/processing_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Processing Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.complete.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/home/complete_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Complete Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.cancle.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/home/cancle_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Cancle Request</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.speciality.index')}}" class="nav-link {{Request::is('admin/speciality*')  ? 'active' : ''}} ">

                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>
                                Speciality
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{(Request::is('admin/doctor*')) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
{{--                            <i class="nav-icon fa fa-flask"></i>--}}
                            <i class="nav-icon fa fa-user-md "></i>
                            <p>
                                Doctor Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.doctor.list')}}"
                                   class="nav-link {{Request::is('admin/doctor/list*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/doctor/list*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Specialist Doctor</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.secmo.doctor.list')}}"
                                   class="nav-link {{Request::is('admin/doctor/secmo/list*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/doctor/secmo/list*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Sacmo Doctor</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.doctor_degree.index')}}"
                                   class="nav-link {{Request::is('admin/doctor_degree*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/doctor_degree*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Doctor's Degree </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{(Request::is('admin/lab*')) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-flask"></i>
                            <p>
                                Lab Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.lab.index')}}"
                                   class="nav-link {{Request::is('admin/lab/index*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/lab/index*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Labs</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('admin.lab_sample_collector.index')}}"
                                   class="nav-link {{Request::is('admin/lab_sample_collector*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/lab_sample_collector*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>   Lab Sample Collector</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.lab_test_request')}}"
                                   class="nav-link {{Request::is('admin/lab_test_request*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/lab_test_request*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p> Lab Test Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.test_chart.index')}}"
                                   class="nav-link {{Request::is('admin/test_chart*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/test_chart*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p> Lab Test Chart</p>
                                </a>
                            </li>
                        </ul>
                    </li>
{{--                    <li class="nav-item has-treeview {{(Request::is('admin/lab*')) ? 'menu-open' : ''}}">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <i class="nav-icon fa fa-flask"></i>--}}
{{--                            <p>--}}
{{--                                Patient Management--}}
{{--                                <i class="right fa fa-angle-left"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="{{route('admin.patient.list')}}"--}}
{{--                                   class="nav-link {{Request::is('admin/patient*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('admin/patient*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>Patient List</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}


                    <li class="nav-item has-treeview {{(Request::is('admin/delivery/man*')) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-person-booth"></i>
                            <p>
                                Delivery Man Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.deliveryMan.list')}}"
                                   class="nav-link {{Request::is('admin/delivery/man*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/delivery/man*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Delivery Man List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.deliveryMan.pending.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/delivery/man/pending_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>D.Man Pending Request  <span class="badge badge-primary"> {{deliveryManRequestCount()}}</span></p>
                                </a>
                            </li>
                             <li class="nav-item">
                                <a href="{{route('admin.deliveryMan.processing.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/delivery/man/processing_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>D.Man Processing Request</p>
                                </a>
                            </li>
                             <li class="nav-item">
                                <a href="{{route('admin.deliveryMan.complete.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/delivery/man/complete_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>D.Man Complete Request</p>
                                </a>
                            </li>
                             <li class="nav-item">
                                <a href="{{route('admin.deliveryMan.cancle.request')}}"
                                   class="nav-link">
                                    <i class="fa fa-{{Request::is('admin/delivery/man/cancle_request/*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>D.Man Cancle Request</p>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li style="display: none" class="nav-item has-treeview {{(Request::is('admin/offer*')) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-gift"></i>
                            <p>
                               Offers
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.offers.index')}}"
                                   class="nav-link {{Request::is('admin/offers/index*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/offers/index*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Offers List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.offer.pending.request')}}"
                                   class="nav-link {{Request::is('admin/offer/pending_request*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/offer/pending_request*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p> Offers Pending Request   <span class="badge badge-primary"> {{offerRequestCount()}}</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.offer.processing.request')}}"
                                   class="nav-link {{Request::is('admin/offer/processing_request*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/offer/processing_request*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p> Offers Processing Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.offer.complete.request')}}"
                                   class="nav-link {{Request::is('admin/offer/complete_request*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/offer/complete_request*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p> Offers Complete Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.offer.cancle.request')}}"
                                   class="nav-link {{Request::is('admin/offer/cancle_request*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/offer/cancle_request*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p> Offers Cancle Request</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.complain.index')}}" class="nav-link {{Request::is('admin/complain*')  ? 'active' : ''}} ">

                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>
                                Complain
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.reasons.index')}}" class="nav-link {{Request::is('admin/reasons*')  ? 'active' : ''}} ">

                            <i class="nav-icon fas fa-medkit"></i>
                            <p>
                                Reasons
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{(Request::is('admin/roles*') || Request::is('admin/staffs*')) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Role & permission
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.staffs.index')}}"
                                   class="nav-link {{Request::is('admin/staffs*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/staffs*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Staff Manage</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.roles.index')}}"
                                   class="nav-link {{Request::is('admin/role*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/roles*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Role Manage</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{(Request::is('admin/profile*') || Request::is('admin/payment*') ) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>
                                Admin
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.profile.index')}}"
                                   class="nav-link {{Request::is('admin/profile') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/profile') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a href=""--}}
{{--                                   class="nav-link {{Request::is('admin/payment/history*') ? 'active' :''}}">--}}
{{--                                    <i class="fa fa-{{Request::is('admin/payment/history*') ? 'folder-open':'folder'}} nav-icon"></i>--}}
{{--                                    <p>Admin Payments History</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{(Request::is('admin/customers*') ) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users Managements
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.customers.index')}}"
                                   class="nav-link {{Request::is('admin/customers') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/customers') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Users List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview {{(Request::is('admin/report*') ) || (Request::is('admin/report*') ) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-file"></i>
                            <p>
                                Reports
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                     <a href="{{route('admin.homeService.index')}}"
                                   class="nav-link {{Request::is('admin/report/homeService*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/report/homeService*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Home Service Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{route('admin.telemedicine.index')}}"
                                   class="nav-link {{Request::is('admin/report/telemedicine*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/report/telemedicine*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Telemedicine Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{route('admin.deliveryMAn.index')}}"
                                   class="nav-link {{Request::is('admin/report/deliveryMAn*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/report/deliveryMAn*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Delivery Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{route('admin.offer.index')}}"
                                   class="nav-link {{Request::is('admin/report/offer*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/report/offer*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Offer Reports</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item has-treeview {{(Request::is('admin/withdraw*') ) || (Request::is('admin/withdraw*') ) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-money"></i>
                            <p>
                                Withdrawals
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                     <a href="{{route('admin.withdraw.pending.request')}}"
                                   class="nav-link {{Request::is('admin/withdraw/pending_request*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/withdraw/pending_request*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Pending Request   <span class="badge badge-primary"> {{withdrawRequestCount()}}</span></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{route('admin.withdraw.complete.request')}}"
                                   class="nav-link {{Request::is('admin/withdraw/complete_request*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/withdraw/complete_request*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Completed Request</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a href="{{route('admin.withdraw.reject.request')}}"
                                   class="nav-link {{Request::is('admin/withdraw/reject_request*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/withdraw/reject_request*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Rejected Request</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                  <li class="nav-item has-treeview {{(Request::is('admin/frontend_settings*') ) || (Request::is('admin/logo*') ) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-comments "></i>
                            <p>
                                Review
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.reviews.index')}}"
                                   class="nav-link {{Request::is('admin/reviews*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/reviews*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Telemedicine Reviews</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.reviews.homeServiceIndex')}}"
                                   class="nav-link {{Request::is('admin/reviews/home*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/reviews/home*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Home service Reviews</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.reviews.deliveryServiceIndex')}}"
                                   class="nav-link {{Request::is('admin/reviews/delivery*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/reviews/delivery*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Delivery service Reviews</p>
                                </a>
                            </li>
                        </ul>
                  </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.reportcheck.list')}}" class="nav-link {{Request::is('admin/reportcheck*')  ? 'active' : ''}} ">

                            <i class="nav-icon fa fa-attachment"></i>
                            <p>
                                Report Check
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview {{(Request::is('admin/frontend_settings*') ) || (Request::is('admin/logo*') ) ? 'menu-open' : ''}}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-desktop"></i>
                            <p>
                                Frontend Settings
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#"
                                   class="nav-link {{Request::is('admin/frontend_settings*') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/frontend_settings*') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Home</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.generalsettings.logo')}}"
                                   class="nav-link {{Request::is('admin/logo') ? 'active' :''}}">
                                    <i class="fa fa-{{Request::is('admin/logo') ? 'folder-open':'folder'}} nav-icon"></i>
                                    <p>Logo Settings</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="{{route('admin.sliders.index')}}" class="nav-link {{Request::is('admin/sliders*')  ? 'active' : ''}} ">

                            <i class="nav-icon fas fa-sliders"></i>
                            <p>
                                Sliders
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.coupon.index')}}" class="nav-link {{Request::is('admin/sliders*')  ? 'active' : ''}} ">

                            <i class="fas fa-gifts"> </i>
                            <p>
                                Coupon
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.business.index')}}" class="nav-link {{Request::is('admin/business*')  ? 'active' : ''}}">

                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p>
                                Business Settings
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.pages.index')}}" class="nav-link {{Request::is('admin/pages*')  ? 'active' : ''}}">

                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p>
                                Pages Settings
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.notification.index')}}" class="nav-link {{Request::is('admin/notification*')  ? 'active' : ''}} ">

                            <i class="fas fa-bell"></i>
                            <p>
                                Notification
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('admin.blogs.index')}}" class="nav-link {{Request::is('admin/blogs*')  ? 'active' : ''}} ">
                            <i class="nav-icon fas fa-newspaper-o"></i>

                            <p>
                                Blogs
                            </p>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="{{route('admin.prescription.index')}}" class="nav-link {{Request::is('admin/prescription*')  ? 'active' : ''}} ">

                            <i class="nav-icon fas fa-medkit"></i>
                            <p>
                                Prescription
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">

                        <a href="{{route('admin.site.optimize')}}" class="nav-link {{Request::is('admin/site-optimize*') ? 'active' : ''}}">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                                Site Optimize
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        @endif
    </div>
    <!-- /.sidebar -->
</aside>















