<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\HomeServiceRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MedicineServiceRequest extends Controller
{
    public function insertRequest(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'patient_id' => 'required',
            'delivery_man_id' => 'required',
            'user_name' => 'required',
            'user_phone' => 'required',
            'user_address' => 'required',
            'delivery_charge' => 'required',
        ]);

        $HSRequest = new HomeServiceRequest();
        $HSRequest->user_id = $request->user_id;
        $HSRequest->patient_id = $request->patient_id;
        $HSRequest->delivery_man_id = $request->specialist_dr_id;
        $HSRequest->user_name = $request->doctor_fee;
        $HSRequest->user_phone = $request->reason_id;
        $HSRequest->code = date('Ymd-his');
        $HSRequest->total_vat = calculatedVatResult($request->doctor_fee);
        $HSRequest->grand_total = calculatedAmountWithVat($request->doctor_fee);
        $HSRequest->specialist_dr_amount = teleMedicineSpDrReceivableAmount($request->doctor_fee);
        $HSRequest->admin_fees = $request->doctor_fee - $HSRequest->specialist_dr_amount;
        $HSRequest->status = 'requested';
        $HSRequest->ssl_status = 'Pending';
        $HSRequest->prob_details = $request->prob_details;
        $image = $request->file('is_prescription_photo');
        if (isset($image)) {
            $imagename = imageUpload($image, 'uploads/reason-attachment/', 0 );
        } else {
            $imagename = $HSRequest->attachment;
        }
        $TMRequest->is_prescription_photo = $imagename;

        if ($TMRequest->save()) {
            return response()->json(['success' => true, 'response' => $TMRequest], 200);
        } else {
            return response()->json(['success' => false, 'response' => 'something went wrong.'], 401);
        }


    }
}
