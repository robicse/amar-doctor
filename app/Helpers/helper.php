<?php
//filter products published
use App\Helpers\UserInfo;
use App\Model\BusinessSetting;
use App\Model\DeliveryManRequest;
use App\Model\HomeServiceRequest;
use App\Model\OfferRequest;
use App\Model\SpecialistDr;
use App\Model\TelemedicineRequest;
use App\Model\Transaction;
use App\Model\VerificationCode;
use App\Model\Withdrawal;
use App\User;
use App\Model\HomeServiceReview;
use App\Model\TelemedicineReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

//unique phone number check
if (! function_exists('phoneNumberCheck')) {
    function phoneNumberCheck($phone) {
        $user = User::where('phone', $phone)->first();
        return 10;
        if (!empty($user)){
            return response()->json([
                'message' => 'Phone number already exist rocky vai :P!!',
            ], 401);
        }

    }
}

//unique email check
if (! function_exists('emailCheck')) {
    function emailCheck($email) {
        $user = User::where('email', $email)->first();
        if (!empty($user)) {
            return response()->json([
                'message' => 'Email already exist rocky vai :P!!',
            ], 401);
        }
    }
}

//image upload
if (! function_exists('imageUpload')) {
    function imageUpload($image, $path,$size) {

        $currentDate = \Illuminate\Support\Carbon::now()->toDateString();
        $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

        if ($size == 0){
            $proImage = Image::make($image)->save($image->getClientOriginalExtension());
        }else{
            $proImage = Image::make($image)->resize($size)->save($image->getClientOriginalExtension());
        }
        Storage::disk('public')->put($path . $imagename, $proImage);
        return $imagename;
    }
}

//image upload
if (! function_exists('imageUploadAndUpdate')) {
    function imageUploadAndUpdate($image, $path,$size,$prevImage) {

        $currentDate = \Illuminate\Support\Carbon::now()->toDateString();
        $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

        //delete old image.....
        if ($prevImage != 'default.png'){
            if (Storage::disk('public')->exists($path. $prevImage)) {
                Storage::disk('public')->delete($path. $prevImage);
            }
        }
        if ($size == 0){
            $proImage = Image::make($image)->save($image->getClientOriginalExtension());
        }else{
            $proImage = Image::make($image)->resize($size)->save($image->getClientOriginalExtension());
        }
        Storage::disk('public')->put($path . $imagename, $proImage);
        return $imagename;
    }
}

//otp send after registration
if (! function_exists('mobileVerification')) {
    function mobileVerification($userReg) {

        $verification = VerificationCode::where('phone',$userReg->phone)->first();
        if (!empty($verification)){
            $verification->delete();
        }
        $verCode = new VerificationCode();
        $verCode->phone = $userReg->phone;
        $verCode->code = mt_rand(1111,9999);
        $verCode->status = 0;
        $verCode->save();

        $text =  $verCode->code. " is your One-Time Password (OTP) for Doctor Pathao. Enjoy with Doctor Pathao ";
        UserInfo::smsAPI("88".$verCode->phone,$text);
        return 200;
    }
}
//show vat
if (! function_exists('vat')) {
    function vat() {
        return BusinessSetting::where('type','vat')->first()->value;
    }
}
//vat calculation
if (! function_exists('calculatedVatResult')) {
    function calculatedVatResult($amount)
    {
        $vat = BusinessSetting::where('type','vat')->first()->value;
        $result = ($amount * $vat) / 100;
        return number_format($result, 2, '.', '');
    }
}
// calculated vat with amount
if (! function_exists('calculatedAmountWithVat')) {
    function calculatedAmountWithVat($amount)
    {
        $vat = BusinessSetting::where('type','vat')->first()->value;
        $result = ($amount * $vat) / 100;
        $total = $amount + $result;
        return number_format($total, 2, '.', '');
    }
}



//  telemedicine doctor amount, deducted admin percentage
if (! function_exists('teleMedicineSpDrReceivableAmount')) {
    function teleMedicineSpDrReceivableAmount($amount, $vat): string
    {
        $drPercent = BusinessSetting::where('type','special_dr_percentage')->first()->value;
        $mainAmount = $amount - $vat;
        $result = ($mainAmount * $drPercent) / 100;
        $total = $mainAmount - $result;
        //dd(number_format($total, 2));
        return number_format($total, 2, '.', '');
    }
}

//  home service sp doctor will get this amount ,
if (! function_exists('homeServiceSpDrReceivableAmount')) {
    function homeServiceSpDrReceivableAmount($amount): string
    {
        $drPercent = BusinessSetting::where('type','sp_dr_home_service_percentage')->first()->value;
        $result = ($amount * $drPercent) / 100;
        return number_format($result, 2, '.', '');
    }
}


//  Specialist Dr discount calculation  ,
if (! function_exists('spDoctorDiscountCalculation')) {
    function spDoctorDiscountCalculation($spDrId): string
    {
        $spDrObj = SpecialistDr::find($spDrId);
        $diExp = $spDrObj->discount_expiry;
        $currentDate =  date('Y-m-d');
        /*if ( $diExp >=  $currentDate){
            dd('remaining');
        }else{
            dd( 'expire');
        }*/
        $disPercentage = $spDrObj->discount_percentage;
        $drFee = $spDrObj->consultation_fee;
        if ($disPercentage > 0  && $diExp >=  $currentDate  ) {
            $perAmount= ($drFee * $disPercentage) / 100;
            $result = $drFee - $perAmount;
            return number_format($result, 2, '.', '');
        }else{
            return number_format($drFee, 2, '.', '');
        }
    }
}

//  Specialist Dr discount check  ,
if (! function_exists('spDoctorIsDiscount')) {
    function spDoctorIsDiscount($spDrId): string
    {
        $spDrObj = SpecialistDr::find($spDrId);
        $diExp = $spDrObj->discount_expiry;
        $currentDate =  date('Y-m-d');
        $disPercentage = $spDrObj->discount_percentage;
        if ($disPercentage > 0  && $diExp >=  $currentDate  ) {
           return 1;
        }else{
            return 0;
        }
    }
}



//  home service SECMO doctor will get this amount
if (! function_exists('homeServiceSecmoDrReceivableAmount')) {
    function homeServiceSecmoDrReceivableAmount($amount)
    {
        $drPercent = BusinessSetting::where('type','secmo_dr_percentage')->first()->value;
        $result = ($amount * $drPercent) / 100;
        //dd(number_format($total, 2));
        return number_format($result, 2, '.', '');
    }
}

//  delivery man  will get this amount
if (! function_exists('DeliveryManRequestReceivableAmount')) {
    function DeliveryManRequestReceivableAmount($amount)
    {
        $drPercent = BusinessSetting::where('type','delivery_man_cost')->first()->value;
        $result = ($amount * $drPercent) / 100;
        //dd(number_format($total, 2));
        return number_format($result, 2, '.', '');
    }
}




//  telemedicine pending request
if (! function_exists('pendingTelemedicineCount')) {
    function pendingTelemedicineCount(): string
    {
        return TelemedicineRequest::where('status','pending')->get()->count();
    }
}

//  home service pending request
if (! function_exists('homeServiceRequestCount')) {
    function homeServiceRequestCount(): string
    {
        return HomeServiceRequest::where('status','pending')->get()->count();
    }
}

//  delivery Man pending request
if (! function_exists('deliveryManRequestCount')) {
    function deliveryManRequestCount(): string
    {
        return DeliveryManRequest::where('status','pending')->get()->count();
    }
}

//  offer pending request
if (! function_exists('offerRequestCount')) {
    function offerRequestCount(): string
    {
        return OfferRequest::where('status','pending')->get()->count();
    }
}
//  offer pending request
if (! function_exists('withdrawRequestCount')) {
    function withdrawRequestCount(): string
    {
        return Withdrawal::where('status','pending')->get()->count();
    }
}


//unique code generator.....
if (! function_exists('getTrx')) {
    function getTrx($length = 12)
    {
        $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

//transaction data save
if (! function_exists('transaction')) {
    function transaction($user_id, $amount,$balance,$charge,$details,$trx,$trx_type) {
        $transaction = new Transaction();
        $transaction->user_id = $user_id;
        $transaction->amount = $amount;
        $transaction->charge = $charge;
        $transaction->post_balance = $balance - $charge;
        $transaction->trx_type = $trx_type;
        $transaction->details = $details;
        $transaction->trx =  $trx;
        $transaction->save();
    }
}

if (! function_exists('GetDistance')) {
     function GetDistance($url){
         //$api ="https://barikoi.xyz/v1/api/distance/MjMzNTpTWlBLSkRHUTRZ/90.39534587,23.86448886/90.3673,23.8340";
         //$api = "https://71bulksms.com/sms_api/bulk_sms_sender.php?api_key=16630227328497042020/04/0406:34:27amPriyojon&sender_id=188&message=".urlencode($sms_text)."&mobile_no=".$receiver_number."&User_Email=info@priyojon.com";
         //dd($api);
         $curl = curl_init();
         curl_setopt_array($curl, array(
             CURLOPT_URL => $url,
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_ENCODING => "",
             CURLOPT_MAXREDIRS => 10,
             CURLOPT_TIMEOUT => 30,
             CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
             CURLOPT_CUSTOMREQUEST => "GET",
             CURLOPT_HTTPHEADER => array(
                 "accept: application/json",
                 "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=="
             ),
         ));
         //dd($curl);
         $response = curl_exec($curl);
         $err = curl_error($curl);

         curl_close($curl);

         if ($err) {
             return $err;
         } else {
             $distance =   json_decode($response);
             return  $distance->Distance;
         }
    }
}
if (! function_exists('GetAddress')) {
    function GetAddress($long,$lat){
        //$api ="https://barikoi.xyz/v1/api/distance/MjMzNTpTWlBLSkRHUTRZ/90.39534587,23.86448886/90.3673,23.8340";
        //$api = "https://71bulksms.com/sms_api/bulk_sms_sender.php?api_key=16630227328497042020/04/0406:34:27amPriyojon&sender_id=188&message=".urlencode($sms_text)."&mobile_no=".$receiver_number."&User_Email=info@priyojon.com";
        $api = "https://barikoi.xyz/v1/api/search/reverse/Mjg5NDo5WVBVM0tOVlZE/geocode?longitude=$long&latitude=$lat";
//        dd($api);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=="
            ),
        ));
        //dd($curl);
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
           $address =   json_decode($response);
            return  $address->place->address;
        }
    }
}
if (! function_exists('secmoRating')) {
    function secmoRating($id)
    {
        $user = \App\Model\SecmoDr::find($id);
        $fiveStarRev = HomeServiceReview::where('secmo_dr_id', $user->id)->where('rating', 5)->where('status', 1)->sum('rating');
        $fourStarRev = HomeServiceReview::where('secmo_dr_id', $user->id)->where('rating', 4)->where('status', 1)->sum('rating');
        $threeStarRev = HomeServiceReview::where('secmo_dr_id', $user->id)->where('rating', 3)->where('status', 1)->sum('rating');
        $twoStarRev = HomeServiceReview::where('secmo_dr_id', $user->id)->where('rating', 2)->where('status', 1)->sum('rating');
        $oneStarRev = HomeServiceReview::where('secmo_dr_id', $user->id)->where('rating', 1)->where('status', 1)->sum('rating');
        $totalRating = HomeServiceReview::where('secmo_dr_id', $user->id)->sum('rating');

        //dd($fiveStarRev);
        if ($totalRating > 0) {
            $rating = (5 * $fiveStarRev + 4 * $fourStarRev + 3 * $threeStarRev + 2 * $twoStarRev + 1 * $oneStarRev) / ($totalRating);
            $totalRatingCount = number_format((float)$rating, 1, '.', '');
        } else {
            $totalRatingCount = number_format((float)0, 1, '.', '');
        }
        if (!empty($totalRatingCount)) {
            return $totalRatingCount;
        } else {
            return 'Something went wrong!';
        }
    }
}
if (! function_exists('specialistDoctorRating')) {
    function specialistDoctorRating($id)
    {
        $user = \App\Model\SpecialistDr::find($id);
        $fiveStarRev = TelemedicineReview::where('specialist_dr_id', $user->id)->where('rating', 5)->where('status', 1)->sum('rating');
        $fourStarRev = TelemedicineReview::where('specialist_dr_id', $user->id)->where('rating', 4)->where('status', 1)->sum('rating');
        $threeStarRev = TelemedicineReview::where('specialist_dr_id', $user->id)->where('rating', 3)->where('status', 1)->sum('rating');
        $twoStarRev = TelemedicineReview::where('specialist_dr_id', $user->id)->where('rating', 2)->where('status', 1)->sum('rating');
        $oneStarRev = TelemedicineReview::where('specialist_dr_id', $user->id)->where('rating', 1)->where('status', 1)->sum('rating');
        $totalRating = TelemedicineReview::where('specialist_dr_id', $user->id)->sum('rating');

        //dd($fiveStarRev);
        if ($totalRating > 0) {
            $rating = (5 * $fiveStarRev + 4 * $fourStarRev + 3 * $threeStarRev + 2 * $twoStarRev + 1 * $oneStarRev) / ($totalRating);
            $totalRatingCount = number_format((float)$rating, 1, '.', '');
        } else {
            $totalRatingCount = number_format((float)0, 1, '.', '');
        }
        if (!empty($totalRatingCount)) {
            return $totalRatingCount;
        } else {
            return 'Something went wrong!';
        }
    }
}


