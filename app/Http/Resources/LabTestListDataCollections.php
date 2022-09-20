<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LabTestListDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
               $user =  User::find($data->user_id);
                return [
                    'lab_tests_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'full_name' => (string) $data->name,
                    'phone' => (string) $data->phone,
                    'address' => (string) $data->address,
                    'status' => (string) $data->status,
                    'lab_sample_collectors_name' => (string) !empty($data->LabSampleCollector) ? $data->LabSampleCollector->name : "Not Assigned" ,
                    'lab_sample_collectors_phone' => (string) !empty($data->LabSampleCollector) ? $data->LabSampleCollector->phone : "Not Assigned" ,
                    'investigation_chart' => (string) $data->investigation_chart,
                    'test_amount' => (string) $data->test_amount == !null ? $data->test_amount : 'Not Assigned',
                    'lab_name' => (string) !empty($data->lab) ? $data->lab->name : "Not Assigned",
                    'test_photos' =>  json_decode($data->test_photo),
                    'test_photos_path' => (string)  '/uploads/test_photo/',
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
