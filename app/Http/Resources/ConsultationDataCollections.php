<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConsultationDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
               //$user =  User::find($data->user_id);
               //dd($data);
                return [
                    'sp_doc_tbl_id' => (int) $data->id,
                    'follow_up_fee' => (string) $data->follow_up_fee,
                    'follow_up_within' => (string) $data->follow_up_within,
                    'discount_percentage' => (string) $data->discount_percentage,
                    'discount_expiry' => (string) $data->discount_expiry,
                    'consultation_duration' => (string) $data->consultation_duration,
                    'consultation_fee' => (string) $data->consultation_fee,
                    'availability' => (string) $data->availability,
                    'consultation_time' => (string) $data->consultation_time,

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
