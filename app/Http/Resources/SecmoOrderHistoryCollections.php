<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\HomeServiceRequest;
use App\Model\Patients;
use App\Model\TelemedicineRequest;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class SecmoOrderHistoryCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $user = User::find($data->user_id);
                return [
                   'name' => $user->name,
                   'email' => $user->email,
                   'phone' => $user->phone,
                   'amount' => $data->amount,
                   'grand_total' => $data->grand_total,
                   'total_vat' => $data->total_vat,
                   'secmo_dr_amount' => $data->secmo_dr_amount,
                   'payment_type' => $data->payment_type,
                   'user_address' => $data->user_address,
                   'secmo_address' => $data->secmo_address,
                   'distance' => $data->distance,
                   'created_at' => $data->created_at,
                   'req_tbl_id' => $data->id,
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
