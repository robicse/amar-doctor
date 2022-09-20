<?php

namespace App\Http\Resources;

use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DoctorSpecialityDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'dr_specialities' => (int) $data->id,
                    'speciality_name' => (string) !empty($data->speciality) ? $data->speciality->name : "",
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
