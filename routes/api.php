<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('encryption/auth')->group(function () {
    Route::post('/login','Api\AuthController@login');
    Route::post('/service/provider/login','Api\AuthController@serviceProviderLogin');
    Route::post('/register','Api\AuthController@register');
    Route::post('/doctor-register','Api\DoctorAuthController@doctorRegister');
    Route::post('/doctor-register/details/data','Api\DoctorAuthController@doctorRegisterDetailsData');
    Route::post('/specialist/doctor/registration','Api\DoctorAuthController@specialistDocReg');
    Route::post('/sacmo/doctor/registration','Api\DoctorAuthController@secmoDocReg');
    Route::post('/secmo-doctor-register','Api\DoctorAuthController@secmoDoctorRegister');
    Route::post('/delivery-man-register','Api\DeliverManController@deliverManRegister');
    Route::post('otp/send', 'Api\OtpVerificationController@OtpSend');
    Route::post('otp/checked', 'Api\OtpVerificationController@OtpCheck');
    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'Api\AuthController@logout');
        //========Start.... user routes or you can say patient's route ==========//
        Route::get('user/profile/details', 'Api\AuthController@userDetails');
        Route::get('user/profile/details/{useId}', 'Api\AuthController@userImageGet');
        Route::post('user/profile/update/{id}', 'Api\AuthController@userProfileUpdate')->name('user.profile.update');
        //======== End.... user routes or you can say patient's route ==========//
        Route::post('change-password', 'Api\AuthController@changePass');

    });
});

Route::prefix('encryption')->group(function () {
    //============= authenticate api's =====================================//
    Route::middleware('auth:api')->group(function () {
        //============= patients api's ===============================//
        Route::post('/lab-test/request/send','Api\LabTestController@postLabTestReport');
        Route::get('/get/lab-test/report/{userId}','Api\LabTestController@getLabTestReport');
        Route::post('/patient/create','Api\PatientController@patientCreate');
        Route::post('/patient/update/{id}','Api\PatientController@patientUpdate')->name('patient.update');
        Route::get('/get/my-all/patient/{myId}','Api\PatientController@getMyAllPatient')->name('get.my-all-patient');
        Route::get('/get/my/consultation/history/by/doctorId/{drId}','Api\PatientController@getMyConsultationHistoryByDrId')->name('get.my-all-patient');
        Route::post('/user/profile/image/update','Api\PatientController@userImageUpload');
        Route::post('/favorite/specialist-dr/add','Api\PatientController@WishlistCreateToSpDr');
        Route::get('/favorite/specialist/dr/list/{userId}','Api\PatientController@userWiseFavorite');
        Route::get('/favorite/specialist/dr/delete/from/list/{listId}','Api\PatientController@userWiseFavoriteDelete');
        Route::get('/get/recent/view/drs/list/{listId}','Api\PatientController@recentDrsViews');
        Route::post('/post/recent/view/drs/in/list','Api\PatientController@postRecentDrs');
        Route::get('/get/recent/visited/drs/list/{userId}','Api\PatientController@recentVisitedDoctor');
        Route::get('/specialist/doctor/full/data','Api\DoctorAuthController@specialistDoctorFullData');
        Route::get('/consultation/history/doctorId/{drId}','Api\DoctorController@consultationHistory');
        Route::get('/telemedicine/earning/history/by/doctorId/{drId}','Api\DoctorController@earningHistory');
        Route::get('/sp-dr-dashboard/doctorId/{drId}','Api\DoctorController@dashboard');


//=========================================== authenticated Doctor api's ============================================//

        Route::post('doctor/education/create', 'Api\EducationController@create');
        Route::post('doctor/education/update', 'Api\EducationController@update');
        Route::post('doctor/experience/create', 'Api\ExperienceController@create');
        Route::post('doctor/experience/update', 'Api\ExperienceController@update');

        //telemedicine request
        Route::post('/post/telemedicine/request','Api\TelemedicineReqController@insertRequest');
        Route::post('/check/patient/followup/fee','Api\TelemedicineReqController@followupFeeCheck');
        //Route::post('/doctor/call/receive/status/change','Api\TelemedicineReqController@drCallReceiveStatusChange');
        Route::post('/after/call-end/post/telemedicine/data','Api\TelemedicineReqController@afterCallEndDataPost');
        Route::post('/telemedicine/review/post','Api\TelemedicineReqController@reviewPost');


        //Home service_____________________________
        Route::post('/post/home/service/request','Api\HomeServiceRequestController@insertRequest');


        Route::post('/home/service/review/post','Api\HomeServiceRequestController@hSReviewPost');


        Route::post('/homeServiceRequestSecmoStatusChange/','Api\HomeServiceRequestController@homeServiceRequestSecmoStatusChange');
        Route::get('/home-Service-Request-Cancel-By-User/{req_tbl_id}','Api\HomeServiceRequestController@homeServiceRequestCancelByUser');
        Route::get('/home-Service-Request-Conversation-Done-By-User/{req_tbl_id}','Api\HomeServiceRequestController@homeServiceRequestConversationDoneByUser');
        Route::get('/home-Service-Request-cancel-by-sacmo/{req_tbl_id}','Api\HomeServiceRequestController@homeServiceRequestCancelBySACMO');



        // prescription add
        Route::post('doctor/will/add/prescription', 'Api\PrescriptionController@create');
        //transaction history
        Route::get('/transaction/history/by/{userId}','Api\TransactionHistoryController@getHistory');
        Route::get('/report/check-list/by/{userId}','Api\ReportCheckController@getHistory1');

        //payment history
        Route::get('/telemedicine/payment/history/{userId}','Api\TransactionHistoryController@telemedicinePaymentHistory');




        //sp dr..
        Route::post('specialist/doctors/is_online', 'Api\DoctorController@specialityDrIsOnline');
        Route::post('add/medicine', 'Api\DoctorController@addMedicine');
        Route::get('get/all/medicine', 'Api\DoctorController@getMedicine');
        Route::get('sp/doctor/get/all/withdraw/history/{userId}', 'Api\DoctorController@getWithdrawHistory');
        Route::post('/sp/doctor/request/for/withdraw','Api\DoctorController@submitWithdraw');
        Route::post('/sp/doctor/availability/update','Api\DoctorController@updateAvailability');
        Route::post('/sp/doctor/consultation/fee/update','Api\DoctorController@consultationFee');
        Route::get('/sp/doctor/consultation/fee/get/{docId}','Api\DoctorController@consultationFeeGet');


        //secmo
        Route::post('sacmo/is_online', 'Api\SecmoController@secmoIsOnline');
        Route::get('sacmo/dashboard/{secmoId}', 'Api\SecmoController@dashboard');
        Route::post('sacmo/profile/update/','Api\SecmoController@updateProfile');
        Route::post('sacmo/bankInformation/update/','Api\SecmoController@updateBankInfo');
        Route::get('/home-service/earning/history/by/secmoId/{secmoId}', 'Api\SecmoController@earningHistory');
        //balance check for all user
        Route::post('/balance/check/for/all/user','Api\CommonDataController@balanceCheck');





    });
    Route::post('sacmo/location-update', 'Api\SecmoController@locationUpdate');
    Route::post('specialist-doctor/experience-update', 'Api\DoctorController@experienceInfoUpdate');

    Route::post('/sp/doctor/signature/update','Api\DoctorController@signatureUpdate');
    // Notification
    Route::get('notification/list/{type}', 'Api\NotificationController@notificationList');
    //call related api.... should be auth
    Route::post('report/check/create', 'Api\ReportCheckController@create');
    Route::post('call/queue/post', 'Api\CallQueueController@storeCallQueue');
    Route::get('sp/doctor/call/queue/data/{drId}', 'Api\CallQueueController@getCallQueue');
    Route::get('sp/doctor/call/queue/complete/data/{drId}', 'Api\CallQueueController@getCompltedCallQueue');
    Route::get('call/to/user/by/doctor/{queueTblId}', 'Api\CallQueueController@callByDocToUser');
    Route::get('patient/not/answer/by/queueId/{queueTblId}', 'Api\CallQueueController@patientNotAnserPost');
    Route::get('patient/call/answer/by/queueId/{queueTblId}', 'Api\CallQueueController@patientCallAnserPost');
    Route::get('call/end/by/doctor/{queueTblId}', 'Api\CallQueueController@callEndByDoctor');
    Route::get('full-request/cancel/by/doctor/{queueTblId}', 'Api\CallQueueController@fullReqCancelByDoctor');

    //Route::get('report/check-list/by/{userId}', 'Api\ReportCheckController@ReportByUser');

    //============================= Unauthenticated Api's=====================================//
    Route::post('forget/password/mobile/number/check', 'Api\AuthController@forgetPassCheck');
    Route::post('create/new/password', 'Api\AuthController@CreateNewPass');
    Route::get('specialist/doctors/list', 'Api\DoctorController@getDoctorsList');
    Route::get('specialist/doctors/list/for/home', 'Api\DoctorController@getDoctorsListForHome');
    Route::get('specialist/doctors/details/{doctorId}', 'Api\DoctorController@getDoctorsDetails');
    Route::get('/get/speciality/wise/specialist/doctors/{specialityId}', 'Api\DoctorController@specialityWiseDrsGet');

    Route::get('doctor/education/get-by-doctor-id/{docId}', 'Api\EducationController@getDataByDocId');
    Route::get('doctor/experience/get-by-doctor-id/{docId}', 'Api\ExperienceController@getDataByDocId');
    Route::post('doctor/about/update', 'Api\ExperienceController@updateAbout');

    //=========================================== Secmo Doctor api's =========================================//
    Route::get('/secmo/doctor/consultation/history/{id}','Api\SecmoController@getSecmoConsultationHistory');
    Route::get('/secmo/doctor/consultation/processing/history/{id}','Api\SecmoController@getSecmoConsultationProcessingHistory');
    Route::get('/secmo/doctor/list','Api\SecmoController@getSecmoDrList');
    Route::post('/secmo/doctor/onlineList','Api\SecmoController@getSecmoDrOnlineList');
    Route::get('/secmo/doctor/details/{secmoId}','Api\SecmoController@getSecmoDrDetails');
    Route::post('/user/selected/secmo/details','Api\SecmoController@userSelectedSecmoData');

    Route::post('user/cancel-request/before/secmo-received','Api\SecmoController@userCancelRequest');
    //Route::post('secmo/cancel-request/or/received-request','Api\SecmoController@secmoCancelRequest');
    //Route::post('user/review/submit','Api\SecmoController@reviewSubmit');

    //=========================================== Delivery Man data api's =========================================//
    Route::get('/delivery-man-lists','Api\DeliverManController@deliverManList');
    Route::get('/delivery-man/dashboard/{id}','Api\DeliverManController@dashboard');
    Route::post('delivery-man/profile/update/','Api\DeliverManController@deliveryManUpdateProfile');
    Route::post('delivery-man/bankInformation/update/','Api\DeliverManController@deliveryManUpdateBankInfo');
    Route::post('/user/selected/delivery-man/details','Api\DeliverManController@userSelectedDeliveryManData');
    Route::post('/delivery-man/onlineList','Api\DeliverManController@getDeliveryManOnlineList');
    Route::post('/delivery-man/request','Api\DeliverManController@deliveryManRequest');
    Route::post('delivery-man/is_online', 'Api\DeliverManController@deliveryManIsOnline');
    Route::get('delivery-man/details/{deliveryManId}', 'Api\DeliverManController@getDeliveryManDetails');
    Route::get('delivery-man/earning/history/{deliveryManId}', 'Api\DeliverManController@earningHistory');
    Route::get('delivery-man/request/cancel/by-user/{dmReqId}', 'Api\DeliverManController@deliveryManRequestCancelByUser');
    Route::get('/delivery-man-Request-Conversation-Done-By-User/{dmReqId}', 'Api\DeliverManController@dmRequestConversationDoneByUser');
    Route::post('dmRequestDmStatusChange', 'Api\DeliverManController@dmRequestDmStatusChange');
    Route::post('dm/service/review/post', 'Api\DeliverManController@dmReviewPost');
    Route::post('delivery/man/service/list', 'Api\DeliverManController@deliveryList');



    //=========================================== Common data api's =========================================//
    Route::get('/get/districts','Api\CommonDataController@GetDistricts');
    Route::get('/get/specialities','Api\CommonDataController@GetSpecialities');
    Route::get('/get/content/pages','Api\CommonDataController@contentPages');
    Route::get('/get/offers','Api\CommonDataController@getOffers');
    Route::get('/get/reason','Api\CommonDataController@reason');
    Route::get('/get/labs','Api\CommonDataController@getLabs');
    Route::get('/get/complain','Api\CommonDataController@getComplain');
    Route::post('/create/complain','Api\CommonDataController@createComplain');
    Route::get('/get/degrees','Api\CommonDataController@getDegrees');
    Route::get('/get/investigation/chart','Api\CommonDataController@getAllTests');
    Route::post('/post/investigation/chart','Api\CommonDataController@TestsStore');
    Route::get('/sliders','Api\SliderController@getSliders');

    //=========================================== Business Settings api's ============================//
    Route::get('/get/business/settings','Api\BusinessSettings@getAllSettings');
    Route::post('/agora/token', 'Api\AgoraVideoController@token');


    //=========================================== Page Settings api's ============================//
    Route::get('/get/terms-and-condition','Api\PageController@getTermsAndCondition');


    //=========================================== Promo Code ============================//

    Route::post('/coupon', 'Api\BusinessSettings@coupon');
});

//ssl commerz..............
Route::post('/checkout/ssl/pay', 'Api\PublicSslCommerzPaymentController@index');
Route::POST('/success', 'Api\PublicSslCommerzPaymentController@success');
Route::POST('/fail', 'Api\PublicSslCommerzPaymentController@fail');
Route::POST('/cancel', 'Api\PublicSslCommerzPaymentController@cancel');
Route::POST('/ipn', 'Api\PublicSslCommerzPaymentController@ipn');
Route::get('/ssl/redirect/{status}','Api\PublicSslCommerzPaymentController@status');
Route::get('/web/payment/{status}','Api\PublicSslCommerzPaymentController@statusWeb');



Route::fallback(function() {
    return response()->json([
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Invalid Route plz check in route file'
    ]);
});
