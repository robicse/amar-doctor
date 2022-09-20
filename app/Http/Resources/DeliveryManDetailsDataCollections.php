<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\Model\TelemedicineRequest;
use App\Model\TelemedicineReview;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DeliveryManDetailsDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    //dd($data),
                    'delivery_man_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'admin_will_pay' => (string) $data->admin_will_pay,
                    'bank_name' => (string) $data->bank_name,
                    'acc_holder_name' => (string) $data->acc_holder_name,
                    'account_number' => (int) $data->account_number,
                    'mob_bank_name' => (int) $data->mob_bank_name,
                    'mob_bank_number' => (int) $data->mob_bank_number,
                    'is_online' => (int) $data->is_online,
                    'is_active' => (int) $data->is_active,
                    'is_approve' => (int) $data->is_approved,
                    'rating' => (double) 4.5,
                    'total_delivery_attend' => (int) 25,
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
