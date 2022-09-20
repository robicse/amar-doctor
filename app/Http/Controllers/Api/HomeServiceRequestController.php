<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\HomeServiceRequest;
use App\Model\HomeServiceReview;
use App\Model\SecmoDr;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Kreait\Firebase\Database;

class HomeServiceRequestController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    public function insertRequest(Request $request)
    {
//        $secmoCheck = HomeServiceRequest::where('secmo_dr_id', $request->secmo_dr_id)
//            ->where('status', 'pending')->latest()->first();

        $secmoCheck = HomeServiceRequest::where('secmo_dr_id', $request->secmo_dr_id)
            ->where(function ($query)  {
                $query->where('status', 'pending')
                    ->orWhere('status', 'processing');
            })->latest()->first();
        if (!empty($secmoCheck)) {
            return response()->json(['success' => false, 'response' => 'Secmo already booked by another patient.'], 422);
        }
        //dd(calculatedAmountWithVat($request->amount));
        $this->validate($request,[
            'user_id' => 'required',
            'secmo_dr_id' => 'required',
            'amount' => 'required',
            'discount' => 'required',
        ]);
        $amount = $request->amount - $request->discount;
        $HSRequest = new HomeServiceRequest();
        $HSRequest->user_id = $request->user_id;
        //$HSRequest->patient_id = $request->patient_id;
        $HSRequest->secmo_dr_id = $request->secmo_dr_id;
        $HSRequest->total_vat_pecentage = vat();
        $HSRequest->amount = $request->amount;
        $HSRequest->discount = $request->discount;
        $HSRequest->code = date('Ymd-his');
        $HSRequest->secmo_dr_status = 'pending';
        $HSRequest->admin_fees = $amount - homeServiceSecmoDrReceivableAmount($request->amount);
        $HSRequest->secmo_dr_amount = homeServiceSecmoDrReceivableAmount($request->amount);
        $HSRequest->total_vat = calculatedVatResult($amount);
        $HSRequest->grand_total = calculatedAmountWithVat($amount);
        //$HSRequest->specialist_dr_amount = homeServiceSpDrReceivableAmount($request->amount);
       // $HSRequest->admin_fees = $request->amount - ($HSRequest->specialist_dr_amount + $HSRequest->secmo_dr_amount);
        $HSRequest->status = 'pending';
        $HSRequest->ssl_status = 'Pending';
        $HSRequest->payment_type = 'later';
        $HSRequest->service_charge_percentage =  BusinessSetting::where('type','secmo_dr_percentage')->first()->value;
        if ($HSRequest->save()) {
            $postData = [
                'hs_req_id' => $HSRequest->id,
                'secmo_dr_id' => $request->secmo_dr_id,
                'status' =>'pending',
                'secmo_dr_status' => 'pending',
            ];
            $dataPostFirebase = $this->database->getReference('homeServiceRequest')->push($postData);
            return response()->json(['success' => true, 'response' => $HSRequest], 200);
        } else {
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }
    }

    public function homeServiceRequestCancelByUser($hs_req_id)
    {
        //dd($hs_req_id);
        $hsRequest = HomeServiceRequest::find($hs_req_id);
        //dd($hsRequest);
        if ($hsRequest->status == 'pending') {
            $hsRequest->status = 'cancel';
            $hsRequest->save();
            $values = $this->database->getReference('homeServiceRequest')->getValue();
            $fbKey =  $this->searchForId($hsRequest->id , $values);
            $updateData = [
                'status' =>'cancel',
                'secmo_dr_status' => 'cancel',
            ];
            $dataGet = $this->database->getReference('homeServiceRequest/'.$fbKey)->update($updateData);
            if (!$dataGet){
                return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
            }
            return response()->json(['success' => true, 'response' => 'Home service request successfully calculated by user.'], 200);
        }else{
            return response()->json(['success' => false, 'response' => "You can't cancel right now."], 401);
        }
    }
    public function homeServiceRequestConversationDoneByUser($hs_req_id)
    {
        $hsRequest = HomeServiceRequest::find($hs_req_id);
        //dd($hsRequest);
        if ($hsRequest->status == 'processing') {
            $hsRequest->status = 'conversationDone';
            $hsRequest->save();
            $values = $this->database->getReference('homeServiceRequest')->getValue();
            $fbKey =  $this->searchForId($hsRequest->id , $values);
            $updateData = [
                'status' =>'conversationDone',
                'secmo_dr_status' => 'conversationDone',
            ];
            $dataGet = $this->database->getReference('homeServiceRequest/'.$fbKey)->update($updateData);
            if (!$dataGet){
                return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
            }
            return response()->json(['success' => true, 'response' => 'Home service request successfully calculated by user.'], 200);
        }else{
            return response()->json(['success' => false, 'response' => "You can't update status right now."], 401);
        }
    }
    public function homeServiceRequestCancelBySACMO($hs_req_id)
    {
        $hsRequest = HomeServiceRequest::find($hs_req_id);
        //dd($hsRequest);
        if ($hsRequest->status == 'processing') {
            $hsRequest->status = 'cancel';
            $hsRequest->secmo_dr_status =  'cancel';
            $hsRequest->save();
            $values = $this->database->getReference('homeServiceRequest')->getValue();
            $fbKey =  $this->searchForId($hsRequest->id , $values);
            $updateData = [
                'status' =>'cancel',
                'secmo_dr_status' => 'cancel',
            ];
            $dataGet = $this->database->getReference('homeServiceRequest/'.$fbKey)->update($updateData);
            if (!$dataGet){
                return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
            }
            return response()->json(['success' => true, 'response' => 'Home service request cancel Successfully.'], 200);
        }else{
            return response()->json(['success' => false, 'response' => "You can't update status right now."], 401);
        }
    }


    public function homeServiceRequestSecmoStatusChange(Request $request)
    {
         $homeService = HomeServiceRequest::find($request->hs_req_id);
         $secmoUserData = SecmoDr::find($homeService->secmo_dr_id)->user;
         $user = User::find($homeService->user_id);
        $secmo_dr_status = '';
        $status = '';
         if ($homeService->status == 'pending' && $request->secmo_dr_status == 'processing'){
             $homeService->secmo_dr_status = 'processing';
             $homeService->status = 'processing';
             $secmo_dr_status =  'processing';
             $status =  'processing';
             $hsRequestData = [
                 'user_name' => $user->name,
                 'user_phone' => $user->phone,
                 'user_photo' => '/uploads/profile/'.$user->avatar_original,
                 'grand_total' => $homeService->grand_total,
                 'visit' =>  $homeService->amount,
                 'discount' => $homeService->discount,
                 'total_vat' => $homeService->total_vat,
                 'user_address' => GetAddress($user->longitude,$user->latitude),
                 'secmo_address' => GetAddress($secmoUserData->longitude,$secmoUserData->latitude),
                 'distance' => GetDistance('https://barikoi.xyz/v1/api/distance/Mjg5NDo5WVBVM0tOVlZE/'.$secmoUserData->longitude .','.$secmoUserData->latitude.'/'.$user->longitude.','.$user->latitude),
             ];
             $homeService->user_address = $hsRequestData['user_address'];
             $homeService->secmo_address = $hsRequestData['secmo_address'];
             $homeService->distance = $hsRequestData['distance'];

         }elseif ($homeService->status == 'pending' && $request->secmo_dr_status == 'cancel'){
             $homeService->secmo_dr_status = 'cancel';
             $homeService->status = 'cancel';
             $secmo_dr_status =  'cancel';
             $status =  'cancel';
         }else{
             return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
         }

         if ($homeService->save()){
             $values = $this->database->getReference('homeServiceRequest')->getValue();
             $fbKey =  $this->searchForId($homeService->id , $values);
             $updateData = [
                 'secmo_dr_status' => $secmo_dr_status,
                 'status' => $status,
             ];
             $dataGet = $this->database->getReference('homeServiceRequest/'.$fbKey)->update($updateData);
             if (!$dataGet){
                 return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
             }
             if ($request->secmo_dr_status == 'processing') {
                 return response()->json(['success' => true, 'response' => $hsRequestData ], 200);
             }else{
                 return response()->json(['success' => true, 'response' => 'successfully status change'], 200);
             }

         }else{
             return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
         }



    }

    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['hs_req_id'] == $id) {
                //dd($key);
                return $key;
            }
        }
        return null;
    }
    public function hSReviewPost(Request $request)
    {
        //dd('sssss');
        $review = new HomeServiceReview();
        $homeService = HomeServiceRequest::find($request->home_service_request_id);
        $review->home_service_request_id = $request->home_service_request_id;
        $review->secmo_dr_id = $homeService->secmo_dr_id;
        $review->user_id = $homeService->user_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->status = 1;
        $review->viewed = 0;
        $review->save();
        if (!empty($review)) {
            return response()->json(['success' => true, 'response' => 'successfully Data Saved'], 200);
        }else {
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }
    }
}
