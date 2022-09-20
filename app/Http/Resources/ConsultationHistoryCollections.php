<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ConsultationHistoryCollections extends ResourceCollection
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
                    'patient_relationship' => (string) !empty($data->patient) ? $data->patient->relationship : 'No data found',
                    'patient_marital_status' => (string) !empty($data->patient) ? $data->patient->marital_status : 'No data found',
                    'patient_marital_photo' => (string) !empty($data->patient) ? '/uploads/patient/photo/'.$data->patient->photo : 'No data found',
                    'main_reasons' => (string) !empty($data->reason) ? $data->reason->problem : 'No reason found!',
                    'prob_details' => (string) $data->prob_details,
                    'consultation_id' => (string) $data->id,
                    'status' => (string) 'Visited',
                    'consultation_type' => (string) $data->consultation_type,
                    'doctor_fee' => (string) $data->grand_total,
                    'time_hum' => (string) $data->created_at->diffForHumans(),
                    'time' => (string) $data->created_at->format('H:i A'),
                    'date' => (string) $data->created_at->format('d-m-Y'),
                    'prescription_pdf_url' => url('prescription/download/pdf/'.$data->prescription_id),
                    'invoice_pdf_url' => url('telemedicine/invoice/download/pdf/'.$data->id),
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
