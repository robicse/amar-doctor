<?php

namespace App\Http\Resources;

use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SecmoDoctorListDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    //dd($data),
                    'secmo_drs_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'full_name' => (string) $data->user->name,
                    'designation' => (string) $data->designation,
                    'bmdc_number' => (string) $data->bmdc_number,
                    'experience' => (string) $data->experience,
                    'avatar_original' => (string) '/uploads/profile/'.$data->user->avatar_original,
                    'rating' => (int) $data->rating,
                    'total_patients_attend' => (int) 45,
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
