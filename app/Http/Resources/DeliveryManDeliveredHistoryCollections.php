<?php

namespace App\Http\Resources;

use App\Model\DeliveryManRequest;
use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\HomeServiceRequest;
use App\Model\Patients;
use App\Model\TelemedicineRequest;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class DeliveryManDeliveredHistoryCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $user = User::find($data->user_id);
                return [
                    'user_name' => $user->name,
                    'user_phone' => $user->phone,
                    'user_photo' => '/uploads/profile/'.$user->avatar_original,
                    'grand_total' => $data->grand_total,
                    'visit' =>  $data->amount,
                    'discount' => $data->discount,
                    'total_vat' => $data->total_vat,
                    'note' => $data->note,
                    'is_prescription_photo' => '/uploads/prescription_photo/'.$data->is_prescription_photo,
                    'user_address' => $data->user_address,
                    'dm_address' => $data->dm_address,
                    'distance' => $data->distance,
                    'dateTime' => $data->created_at,

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
