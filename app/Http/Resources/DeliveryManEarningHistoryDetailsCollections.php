<?php

namespace App\Http\Resources;

use App\Model\BusinessSetting;
use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DeliveryManEarningHistoryDetailsCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                //dd($data);
                return [
                    'dm_req_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'user_name' => (string)  $data->user_name,
                    'user_phone' => (string)  $data->user_phone,
                    'patient_photo' => (string)  '/uploads/profile/'.$data->user->avatar_original,
                    'fee' => (double) $data->grand_total,
                    'service_fee_percentage' => (double)  $data->service_charge_percentage,
                    'delivery_man_cost' => (double) $data->delivery_man_cost,

                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
