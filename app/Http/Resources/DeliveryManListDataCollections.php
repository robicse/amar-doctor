<?php

namespace App\Http\Resources;

use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DeliveryManListDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $user = User::find($data->user_id);
                return [
                    'delivery_man_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'title_full_name' => (string)  $user->name,
                    'phone' => (string) $user->phone,
                    'photo' => (string) $user->avatar_original,
                    'delivery_charge' => (string) $data->doctor_code,
                    'rating' => (int) $data->rating,
                    'total_completed_delivery' => (int) 45,
                    /*'links' => [
                        'dr_details_link' => url('api/encryption/specialist/doctors/details/'.$data->id),
                    ]*/
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
