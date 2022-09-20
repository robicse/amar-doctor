<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\Model\TelemedicineRequest;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QueueCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
               if ($data->request_type == 'telemedicine'){
                   $requestData = TelemedicineRequest::find($data->request_id);
                   //dd($requestData);
               }
                return [
                    'queue_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'specialist_dr_id' => (int) $data->specialist_dr_id,
                    'req_tbl_id' => (int) $data->request_id,
                    'request_type' => (string) $data->request_type,
                    'channel_name' => (string) $data->channel_name,
                    'status' => (string) $data->status,
                    'patient_status' => (string) $data->patient_status,
                    'token' => (string) $data->token,
                    'patient_name' => (string) !empty($requestData) ? $requestData->patient->name : 'No data found',
                    'patient_gender' => (string) !empty($requestData) ? $requestData->patient->gender : 'No data found',
                    'patient_weight' => (string) !empty($requestData) ? $requestData->patient->weight.' Kg' : 'No data found',
                    'patient_age' => (string) !empty($requestData) ? $requestData->patient->age_year.' years, '. $requestData->patient->age_month.' Months' : 'No data found',
                    'patient_relationship' => (string) !empty($requestData) ? $requestData->patient->relationship : 'No data found',
                    'patient_marital_status' => (string) !empty($requestData) ? $requestData->marital_status : 'No data found',
                    'patient_marital_photo' => (string) !empty($requestData) ? '/uploads/patient/photo/'.$requestData->patient->photo : 'No data found',
                    'main_reasons' => (string) !empty($requestData) ? $requestData->reason->problem : 'No reason found!',
                    'prob_details' => (string) $requestData->prob_details,
                    'prob_details_attachment' => json_decode($requestData->attachment),
                    'attachment_path' => '/uploads/reason-attachment/',
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
