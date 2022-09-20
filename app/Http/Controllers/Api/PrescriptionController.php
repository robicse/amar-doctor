<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\CallQueue;
use App\Model\Prescriptions;
use App\Model\TelemedicineRequest;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function create(Request $request)
    {
        $userId = null;
        $patientId = null;
        $specialist_dr_id = null;
        $queue = CallQueue::find($request->queue_tbl_id);
        if ($queue->request_type == 'telemedicine'){
            $requestData = TelemedicineRequest::where('id', $queue->request_id )->where('status', 'processing')->first();
            $userId = $requestData->user_id;
            $patientId = $requestData->patient_id;
            $specialist_dr_id = $requestData->specialist_dr_id;
        }

        $prescription = new Prescriptions();
        $prescription->user_id = $userId;
        $prescription->patient_id = $patientId;
        $prescription->specialist_dr_id = $specialist_dr_id;
        $prescription->symptoms = $request->symptoms;
        $prescription->tests = $request->tests;
        $prescription->advice = $request->advice;
        $prescription->medicine_details = $request->medicine_details;
        $prescription->follow_up_within = $request->follow_up_within;
        $prescription->save();
        if (!empty($prescription)){
            return response()->json(['success'=>true,'response'=> $prescription], 200);
        }else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }
}
