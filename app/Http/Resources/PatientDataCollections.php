<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PatientDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'name' => (string) $data->name,
                    'gender' => (string) $data->gender,
                    'relationship' => (string) $data->relationship,
                    'age_year' => (string) $data->age_year,
                    'age_month' => (string) $data->age_month,
                    'weight' => (string) $data->weight,
                    'marital_status' => (string) $data->marital_status,
                    'photo' => (string) '/uploads/patient/photo/'.$data->photo,
                    'links'=> [
                        'patient_edit' => route('patient.update',$data->id),
                    ]
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
