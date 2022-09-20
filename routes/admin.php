<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/h_service/invoice/{id}', 'Admin\TelemedicineController@invoice')->name('h_service.invoice');
Route::get('/h_service/invoice/print/{id}', 'Admin\TelemedicineController@invoicePrint')->name('h_service.invoice.print');


Route::get('/admin/login', 'Admin\AuthController@ShowLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AuthController@LoginCheck')->name('admin.login.check');
Route::group(['as'=>'admin.','prefix' =>'admin','namespace'=>'Admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('roles','RoleController');
    Route::post('/roles/permission','RoleController@create_permission');
    Route::resource('staffs','StaffController');
    Route::resource('brands','BrandController');
    Route::resource('offers','OfferController');
    Route::post('offers/search/doctors','OfferController@searchDoctors')->name('offers.search.doctors');
    Route::resource('speciality','SpecialityController');
    Route::resource('lab','LabController');
    Route::resource('lab_sample_collector','LabSampleCollectorController');
    Route::resource('doctor_degree','DegreeController');
    Route::resource('reasons','ReasonController');
    Route::resource('complain','ComplainController');
    Route::resource('test_chart','TestChartController');
    Route::resource('medicine_list','MedicineListController');
    Route::resource('notification','NotificationController');

    Route::get('/test-firebase','FirebaseController@index');
    Route::get('/test-firebase/all/data','FirebaseController@showAll');
    //////////////////////////// CK editor//////////////////////////////
    Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

//////////////////////////////Report Check ////////////////////////////////

    Route::get('/reportcheck/list','ReportCheckController@index')->name('reportcheck.list');
    Route::get('/reportcheck/show/{id}','ReportCheckController@show')->name('reportcheck.show');
    Route::get('/reportcheck/status/{id}','ReportCheckController@reportStatus')->name('reportcheck.status');


    //Offer published / unpublished
    Route::post('offers/publish', 'OfferController@is_publish')->name('offers.is_publish');


    //Doctor Offer Store
    Route::post('offers/drOfferStore','OfferController@drOfferStore')->name('drOfferStore');
    Route::post('offers/single/doctor/insert','OfferController@singleDrInset')->name('offer.singleDrInset');
    Route::post('offers/single/doctor/delete','OfferController@singleDrDelete')->name('offer.singleDrDelete');

    // Offer All Request
    Route::get('/offer/pending_request','OfferController@pending')->name('offer.pending.request');
    Route::get('/offer/processing_request','OfferController@processing')->name('offer.processing.request');
    Route::get('/offer/complete_request','OfferController@complete')->name('offer.complete.request');
    Route::get('/offer/cancle_request','OfferController@cancle')->name('offer.cancle.request');
    Route::get('/offer/request/show/{id}','OfferController@requestShow')->name('offer.request.show');
    Route::get('/search/doctor/', 'OfferController@search_doctor');

    //home service request
    Route::get('/home/pending_request','HomeServiceController@pending')->name('pending.request');
    Route::get('/home/processing_request','HomeServiceController@processing')->name('processing.request');
    Route::get('/home/complete_request','HomeServiceController@complete')->name('complete.request');
    Route::get('/home/cancle_request','HomeServiceController@cancle')->name('cancle.request');
    Route::get('/home/pending_request/show/{id}','HomeServiceController@requestShow')->name('request.show');

    //Medicine service request
    Route::get('/telemedicine/pending_request','TelemedicineController@pending')->name('telemedicine.pending.request');
    Route::get('/telemedicine/processing_request','TelemedicineController@processing')->name('telemedicine.processing.request');
    Route::get('/telemedicine/complete_request','TelemedicineController@complete')->name('telemedicine.complete.request');
    Route::get('/telemedicine/cancle_request','TelemedicineController@cancle')->name('telemedicine.cancle.request');
    Route::get('/telemedicine/pending_request/show/{id}','TelemedicineController@requestShow')->name('telemedicine.request.show');

    // Lab test request
    Route::get('/lab_test_request','LabTestRequestController@index')->name('lab_test_request');
    Route::get('/lab_test_request/show/{id}','LabTestRequestController@show')->name('lab_test_request.show');
    Route::post('/lab_test_request/update/{id}','LabTestRequestController@update')->name('lab_test_request.update');


    //doctor managements
    Route::get('/doctor/list','DoctorController@index')->name('doctor.list');
    Route::get('/doctor/show/{id}','DoctorController@show')->name('doctor.show');
    Route::post('/doctor/update/{id}','DoctorController@update')->name('doctor.update');
    Route::post('doctor/update/profile/{id}','DoctorController@updateDoctorProfile')->name('doctor.profile.update');
    Route::post('doctor/password/update/{id}','DoctorController@updatePassword')->name('doctor.password.update');
    Route::post('doctor/is_approved', 'DoctorController@is_approved')->name('doctor.is_approved');
    Route::post('doctor/is_active', 'DoctorController@is_active')->name('doctor.is_active');
    Route::get('doctor/ban/{id}','DoctorController@ban')->name('doctor.ban');
    Route::get('doctor/transaction/{id}','DoctorController@transaction')->name('doctor.transaction');


    //Sacmo doctor managements
    Route::get('doctor/secmo/list','SecmoController@index')->name('secmo.doctor.list');
    Route::get('doctor/secmo/show/{id}','SecmoController@show')->name('secmo.doctor.show');
    Route::post('doctor/secmo/update/{id}','SecmoController@update')->name('secmo.doctor.update');
    Route::post('doctor/secmo/update/profile/{id}','SecmoController@updateDoctorProfile')->name('secmo.doctor.profile.update');
    Route::post('doctor/secmo/password/update/{id}','SecmoController@updatePassword')->name('secmo.doctor.password.update');
    Route::post('doctor/secmo/is_approved', 'SecmoController@is_approved')->name('secmo.doctor.is_approved');
    Route::post('doctor/secmo/is_active', 'SecmoController@is_active')->name('secmo.doctor.is_active');
    Route::get('doctor/secmo/ban/{id}','SecmoController@ban')->name('secmo.doctor.ban');
    Route::get('doctor/secmo/transaction/{id}','SecmoController@transaction')->name('secmo.doctor.transaction');

    //Delivery Man managements
    Route::get('delivery/man/list','DeliveryController@index')->name('deliveryMan.list');
    Route::get('delivery/man/show/{id}','DeliveryController@show')->name('deliveryMan.show');
    Route::post('delivery/man/update/{id}','DeliveryController@update')->name('deliveryMan.update');
    Route::post('delivery/man/update/profile/{id}','DeliveryController@updateDeliveryManProfile')->name('deliveryMan.profile.update');
    Route::post('delivery/man/password/update/{id}','DeliveryController@updatePassword')->name('deliveryMan.password.update');
    Route::post('delivery/man/is_approved', 'DeliveryController@is_approved')->name('deliveryMan.is_approved');
    Route::post('delivery/man/is_active', 'DeliveryController@is_active')->name('deliveryMan.is_active');
    Route::get('delivery/man/ban/{id}','DeliveryController@ban')->name('deliveryMan.ban');
    Route::get('delivery/man/transaction/{id}','DeliveryController@transaction')->name('deliveryMan.transaction');


    Route::get('/delivery/man/pending_request','DeliveryController@pending')->name('deliveryMan.pending.request');
    Route::get('/delivery/man/processing_request','DeliveryController@processing')->name('deliveryMan.processing.request');
    Route::get('/delivery/man/complete_request','DeliveryController@complete')->name('deliveryMan.complete.request');
    Route::get('/delivery/man/cancle_request','DeliveryController@cancle')->name('deliveryMan.cancle.request');
    Route::get('/delivery/man/pending_request/show/{id}','DeliveryController@requestShow')->name('deliveryMan.request.show');

    //Patient managements
    Route::get('/patient/list','PatientController@index')->name('patient.list');
    Route::get('/patient/show/{id}','PatientController@show')->name('patient.show');
    Route::post('/patient/update/{id}','PatientController@update')->name('patient.update');


    //Business Settings
    Route::get('business/settings','BusinessController@index')->name('business.index');
    Route::post('h_service_day_cost/update','BusinessController@h_service_day_cost_Update');
    Route::post('h_service_night_cost/update','BusinessController@h_service_night_cost_Update');
    Route::post('vat/update','BusinessController@vatUpdate');
    Route::post('special_dr_percentage/update','BusinessController@special_dr_percentage_Update');
    Route::post('special_dr_home_service_percentage/update','BusinessController@special_dr_home_service_percentage');
    Route::post('secmo_dr_percentage/update','BusinessController@secmo_dr_percentage_Update');
    Route::post('delivery_man_cost/update','BusinessController@delivery_man_cost_Update');
    Route::post('offer_start_time/update','BusinessController@offer_start_time');
    Route::post('offer_end_time/update','BusinessController@offer_end_time');
    Route::post('offer_status/update','BusinessController@offer_status');
    Route::post('h_service_start_time/update','BusinessController@h_service_start_time');
    Route::post('h_service_end_time/update','BusinessController@h_service_end_time');
    Route::post('h_service_status/update','BusinessController@h_service_status');



    //Pages Settings
    Route::get('pages/settings','PageController@index')->name('pages.index');
    Route::post('page/data/update','PageController@pageDataUpdate');
    Route::post('page/editor/show','PageController@editorShow')->name('pages.editor.show');



    //Frontend Home Setting
    Route::resource('generalsettings','GeneralSettingController');
    Route::get('/logo','GeneralSettingController@logo')->name('generalsettings.logo');
    Route::post('/logo','GeneralSettingController@storeLogo')->name('generalsettings.logo.store');
    Route::resource('banners','BannerController');

    Route::resource('coupon','CouponController');
    Route::post('/coupon/get_form', 'CouponController@get_coupon_form')->name('coupon.get_coupon_form');
    Route::post('/products/get_products_by_subcategory', 'ProductController@get_products_by_subcategory')->name('products.get_products_by_subcategory');
    Route::post('/coupon/get_form_edit', 'CouponController@get_coupon_form_edit')->name('coupon.get_coupon_form_edit');



    // Admin User Management
    Route::resource('customers','CustomerController');
    Route::get('customer/ban/{id}','CustomerController@ban')->name('customer.ban');
    Route::get('customers/show/profile/{id}','CustomerController@profileShow')->name('customers.profile.show');
    Route::get('customers/show/paitent/{id}','CustomerController@patientList')->name('customers.paitent.show');
    Route::put('customers/update/profile/{id}','CustomerController@updateProfile')->name('customer.profile.update');
    Route::put('customers/password/update/{id}','CustomerController@updatePassword')->name('customer.password.update');
//    Route::get('customers/ban/{id}','CustomerController@banCustomer')->name('customers.ban');
    Route::get('customers/transaction/{id}','CustomerController@transaction')->name('customers.transaction');


    //Sliders
    Route::resource('sliders','SliderController');

    //all reviews
    Route::get('/reviews','ReviewController@index')->name('reviews.index');
    Route::post('review/details', 'ReviewController@reviewDetails')->name('review.details');
    Route::post('review/status/update', 'ReviewController@updateStatus')->name('review-status.update');
    Route::get('review/show/{id}','ReviewController@show')->name('review.view');
    Route::post('review/update/{id}','ReviewController@reviewUpdate')->name('review.update');

    Route::get('/reviews/home/service','ReviewController@homeServiceIndex')->name('reviews.homeServiceIndex');
    Route::post('review/home/service/details', 'ReviewController@homeServiceReviewDetails')->name('review.homeServicedetails');
    Route::post('review/home/service/status/update', 'ReviewController@updateHomeServiceStatus')->name('review-status.homeServiceUpdate');
    Route::get('review/home/service/show/{id}','ReviewController@homeServiceShow')->name('review.homeServiceView');
    Route::post('review/home/service/update/{id}','ReviewController@homeServiceReviewUpdate')->name('homeServiceReview.update');

    Route::get('/reviews/delivery/service','ReviewController@deliveryServiceIndex')->name('reviews.deliveryServiceIndex');
    Route::post('review/delivery/service/details', 'ReviewController@deliveryServiceReviewDetails')->name('review.deliveryServicedetails');
    Route::post('review/delivery/service/status/update', 'ReviewController@updateDeliveryServiceStatus')->name('review-status.deliveryServiceUpdate');
    Route::get('review/delivery/service/show/{id}','ReviewController@deliveryServiceShow')->name('review.homeServiceView');
    Route::post('review/delivery/service/update/{id}','ReviewController@deliveryServiceReviewUpdate')->name('deliveryServiceReview.update');

    //Blogs
    Route::resource('blogs','BlogController');
    Route::post('blog/status', 'BlogController@updateStatus')->name('blog.status');

    Route::resource('advertisement','AdvertisementController');
    Route::resource('profile','ProfileController');
    Route::put('password/update/{id}','ProfileController@updatePassword')->name('password.update');

    //Reports

    Route::get('/report/telemedicine','ReportController@telemedicineIndex')->name('telemedicine.index');
    Route::get('/report/homeService','ReportController@homeServiceIndex')->name('homeService.index');
    Route::get('/report/deliveryMAn','ReportController@deliveryMAnIndex')->name('deliveryMAn.index');
    Route::get('/report/offer','ReportController@offerIndex')->name('offer.index');
    Route::get('report/telemedicine/result','ReportController@telemedicineReport')->name('telemedicine.report');
    Route::get('report/homeService/result','ReportController@homeServiceReport')->name('homeService.report');
    Route::get('report/deliveryMAn/result','ReportController@deliveryMAnReport')->name('deliveryMAn.report');
    Route::get('report/offer/result','ReportController@offerReport')->name('offer.report');



//////////////////////////////////// Withdrawals //////////////////////////////////////////////////

    Route::get('/withdraw/pending_request','WithdrawalController@pending')->name('withdraw.pending.request');
    Route::get('/withdraw/complete_request','WithdrawalController@complete')->name('withdraw.complete.request');
    Route::get('/withdraw/reject_request','WithdrawalController@reject')->name('withdraw.reject.request');
    Route::post('/withdrawals_modal/details','WithdrawalController@detailsModal')->name('withdrawals_modal.details');
    Route::post('/withdrawals/status','WithdrawalController@changeStatus')->name('withdrawals.status');


//!==============================================PDF==============================================================!>
    Route::get('/prescription', 'PDFController@index')->name('prescription.index');
    Route::get('/prescription/pdf/{id}', 'PDFController@show')->name('prescription.show');
    Route::get('/prescription/download/pdf/{id}', 'PDFController@prescriptionDownload')->name('prescription.download');







    Route::get('/h_service/invoice/{id}', 'TelemedicineController@invoice')->name('h_service.invoice');
    Route::get('/h_service/invoice/print/{id}', 'TelemedicineController@invoicePrint')->name('h_service.invoice.print');

    //performance
    Route::get('/config-cache', 'SystemOptimize@ConfigCache')->name('config.cache');
    Route::get('/clear-cache', 'SystemOptimize@CacheClear')->name('cache.clear');
    Route::get('/view-cache', 'SystemOptimize@ViewCache')->name('view.cache');
    Route::get('/view-clear', 'SystemOptimize@ViewClear')->name('view.clear');
    Route::get('/route-cache', 'SystemOptimize@RouteCache')->name('route.cache');
    Route::get('/route-clear', 'SystemOptimize@RouteClear')->name('route.clear');
    Route::get('/site-optimize', 'SystemOptimize@Settings')->name('site.optimize');






});
