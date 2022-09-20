<?php

namespace App\Http\Resources;

use App\Model\BusinessSetting;
use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SpDoctorEarningHistoryDetailsCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
               //$user =  User::find($data->user_id);
               //dd($data);
                return [
                    'telemedicine_req_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'patient_name' => (string) !empty($data->patient) ? $data->patient->name : 'No data found',
                    'patient_gender' => (string) !empty($data->patient) ? $data->patient->gender : 'No data found',
                    'patient_weight' => (string) !empty($data->patient) ? $data->patient->weight.' Kg' : 'No data found',
                    'patient_age' => (string) !empty($data->patient) ? $data->patient->age_year.' years, '. $data->patient->age_month.' Months' : 'No data found',
                    'patient_photo' => (string) !empty($data->patient) ? '/uploads/patient/photo/'.$data->patient->photo : 'No data found',
                    'fee' => (double) $data->grand_total,
                    'service_fee_percentage' => (double) $data->service_charge_percentage,
                    'doctor_fee' => (double) $data->specialist_dr_amount,

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
