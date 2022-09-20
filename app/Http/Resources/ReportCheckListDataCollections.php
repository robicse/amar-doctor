<?php

namespace App\Http\Resources;

use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportCheckListDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    //dd($data),
                    'report_check_tbl_id' => (int) $data->id,
                    'user_id' => (string) $data->user_id,
                    'name' => (string) $data->name,
                    'address' => (string) $data->address,
                    'phone' => (string) $data->phone,
                    'path' => (string) 'uploads/reportcheck/',
                    'attachment' => json_decode($data->attachment),
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
