<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SecmoDoctorDetailsDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    //dd($data),
                    'secmo_drs_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'about' => (string) $data->about,
                    'designation' => (string) $data->designation,
                    'bmdc_number' => (string) $data->bmdc_number,
                    'experience' => (string) $data->experience,
                    'current_employment' => (string) $data->current_employment,
                    'bank_name' => (string) $data->bank_name,
                    'acc_holder_name' => (string) $data->acc_holder_name,
                    'account_number' => (string) $data->account_number,
                    'mob_bank_name' => (string) $data->mob_bank_name,
                    'mob_bank_number' => (string) $data->mob_bank_number,
                    'rating' => (int) $data->rating,
                    'total_patients_attend' => (int) 45,
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
