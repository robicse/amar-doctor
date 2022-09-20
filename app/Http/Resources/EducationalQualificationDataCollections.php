<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EducationalQualificationDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'edu_quli_tbl_id' => $data->id,
                    'specialist_dr_id' => (int) $data->specialist_dr_id,
                    'degree_id' => (string) $data->degree_id,
                    'degree_name' => (string) $data->degree->name,
                    'institute_name' => (string) $data->institute_name,
                    'country_name' => (string) $data->country_name,
                    'passing_year' => (string) $data->passing_year,
                    'duration' => (string) $data->duration,
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
