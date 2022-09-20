<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\CallQueue;
use App\Model\SpecialistDr;
use App\Model\TelemedicineRequest;
use App\Model\TelemedicineReview;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Kreait\Firebase\Database;

class TelemedicineReqController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    //patient followup fee checker
    public function followupFeeCheck(Request $request)
    {
        $this->validate($request,[
            'patient_id' => 'required',
            'specialist_dr_id' => 'required',
        ]);

        $patientOrder = TelemedicineRequest::where('patient_id',$request->patient_id)
            ->where('specialist_dr_id',$request->specialist_dr_id)
            ->where('ssl_status','Completed')->where('status', 'complete')->latest()->first();
        //dd($patientOrder->SpecialistDr);
        $doctor = SpecialistDr::find($request->specialist_dr_id);
        if (!empty($patientOrder) && $doctor->is_followup == 1){
            $spDrObj =  $doctor;
            $currentDate =  Carbon::now()->format('d-m-Y');
            $followUpDateCheck = $patientOrder->created_at->addDays($spDrObj->follow_up_within)->format('d-m-Y');

            $remainingDay = (Carbon::parse($followUpDateCheck)->diffInDays($currentDate));
            //dd($remainingDay);
            //$currentDate >=  $followUpDateCheck
            if ( $remainingDay > 0  ){
                $data = [];
                $data['isVisited'] = true;
                $data['followupFee'] = calculatedAmountWithVat($spDrObj->follow_up_fee);
                $data['totalVat'] = calculatedVatResult($spDrObj->follow_up_fee);
                $data['vatPercentage'] = vat();
                $data['regularFee'] = 0;
                $data['consultation_type'] = "Old";
                $data['remainingDay'] = $remainingDay;
                $data['isDiscount'] = spDoctorIsDiscount($spDrObj->id);

                if ( $data['remainingDay'] !== null) {
                    return response()->json(['success' => true, 'response' => $data], 200);
                } else {
                    return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
                }
            }else{
                //return 'expaired';
                $data = [];
                $data['isVisited'] = false;
                $data['regularFee'] = calculatedAmountWithVat(spDoctorDiscountCalculation($doctor->id));
                $data['totalVat'] = calculatedVatResult(spDoctorDiscountCalculation($doctor->id));
                $data['vatPercentage'] = vat();
                $data['followupFee'] = 0;
                $data['consultation_type'] = "New";
                $data['remainingDay'] = 0;
                $data['isDiscount'] = spDoctorIsDiscount($doctor->id);

                if ( $data['regularFee'] !== null) {
                    return response()->json(['success' => true, 'response' => $data], 200);
                } else {
                    return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
                }

            }
        }else{
            $data = [];
            $data['isVisited'] = false;
            $data['regularFee'] = calculatedAmountWithVat(spDoctorDiscountCalculation($doctor->id));
            $data['totalVat'] = calculatedVatResult(spDoctorDiscountCalculation($doctor->id));
            $data['vatPercentage'] = vat();
            $data['followupFee'] = 0;
            $data['consultation_type'] = "New";
            $data['remainingDay'] = 0;
            $data['isDiscount'] = spDoctorIsDiscount($doctor->id);

            if ( $data['regularFee'] !== null) {
                return response()->json(['success' => true, 'response' => $data], 200);
            } else {
                return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
            }
        }
    }

    public function insertRequest(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'patient_id' => 'required',
            'specialist_dr_id' => 'required',
            'doctor_fee' => 'required',
            //'reason_id' => 'required',
        ]);
        $TMRequest = new TelemedicineRequest();
        $TMRequest->user_id = $request->user_id;
        $TMRequest->patient_id = $request->patient_id;
        $TMRequest->specialist_dr_id = $request->specialist_dr_id;
        $TMRequest->doctor_fee = $request->doctor_fee;
        $TMRequest->service_charge_percentage = BusinessSetting::where('type','special_dr_percentage')->first()->value;
        if ($request->reason_id == null){
            $TMRequest->reason_id = 1;
        }else{
            $TMRequest->reason_id = $request->reason_id;
        }
        $TMRequest->code = date('Ymd-his');
        $TMRequest->total_vat_pecentage = $request->total_vat_pecentage;
        $TMRequest->total_vat = $request->total_vat;
        $TMRequest->grand_total = $request->doctor_fee;
        $TMRequest->specialist_dr_amount = teleMedicineSpDrReceivableAmount($request->doctor_fee, $request->total_vat);
        $TMRequest->admin_fees = ($request->doctor_fee - $TMRequest->specialist_dr_amount) - $request->total_vat;
        $TMRequest->status = 'requested';
        $TMRequest->ssl_status = 'Pending';
        $TMRequest->prob_details = $request->prob_details;
        $TMRequest->consultation_type = $request->consultation_type;

        $attachments = array();
        $images = $request->file('attachment');
        if (isset($images)){
            foreach ($images as $image){
                if (isset($image)) {
                    $imagename = imageUpload($image, 'uploads/reason-attachment/',0);
                }else {
                    $imagename = [];
                }
                array_push($attachments, $imagename);
            }
            $TMRequest->attachment = json_encode($attachments);
        }
        $TMRequest->save();
        $agoraToken =  AgoraVideoController::token($request->user_id);
        //dd($agoraToken);
        $TMRequest['agoraToken'] = $agoraToken;
        if ($TMRequest !== null) {
            return response()->json(['success' => true, 'response' => $TMRequest], 200);
        } else {
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }
    }

    public function drCallReceiveStatusChange(Request $request)
    {
        $requestData = TelemedicineRequest::where('id', $request->telemedicine_request_tbl_id )->where('status', 'pending')->first();
        if (!empty($requestData)){
            $requestData->status = 'processing';
            $callQueue = CallQueue::find($request->call_queue_tbl_id);
            $callQueue->status = 'completed';
            $callQueue->save();
            if ($requestData->save()) {
                return response()->json(['success' => true, 'response' => 'successfully status change'], 200);
            }else {
                return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
            }
        }else{
            return response()->json(['success' => false, 'response' => 'This Request already been processed.'], 401);
        }

    }

    public function afterCallEndDataPost(Request $request)
    {
        //dd($request->all());
        $queue = CallQueue::find($request->queue_tbl_id);
        if ($queue->request_type == 'telemedicine'){
            $requestData = TelemedicineRequest::where('id', $queue->request_id )->where('status', 'processing')->first();
        }

        if (!empty($requestData)){
            $requestData->status = 'complete';
            $requestData->prescription_id = $request->prescription_id;
            $requestData->save();
            $drAmount = $requestData->specialist_dr_amount;
            $trx = getTrx();
            //Doctor User object...........
            $drUserData = $requestData->SpecialistDr->user;
            $drUserData->balance += $drAmount;
            $drUserData->save();
            //Transaction helper function...
            transaction($drUserData->id,$drAmount,$drUserData->balance,0,'Telemedicine Earn',$trx,'+');

            if (!empty($requestData)) {
                $values = $this->database->getReference('callQueue')->getValue();
                $fbKey =  $this->searchForId($queue->id , $values);
                //dd($fbKey);
                $updateData = [
                    'prescription' => 'completed',
                    'prescription_url' => 'prescription/download/pdf/'.$requestData->prescription_id,

                ];
                $dataGet = $this->database->getReference('callQueue/'.$fbKey)->update($updateData);
                if (!$dataGet){
                    return response()->json(['success'=>false,'response'=>'Something went wrong in firebase'], 401);
                }
                return response()->json(['success' => true, 'response' => 'successfully status change'], 200);
            }else {
                return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
            }
        }else{
            return response()->json(['success' => false, 'response' => 'This Request already been complete.'], 401);
        }
    }
    //review
    public function reviewPost(Request $request)
    {
        $review = new TelemedicineReview();
        $review->telemedicine_requests_id = $request->telemedicine_requests_id;
        $review->specialist_dr_id = $request->specialist_dr_id;
        $review->user_id = $request->user_id;
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

    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['queue_tbl_id'] == $id) {
                return $key;
            }
        }
        return null;
    }

}
