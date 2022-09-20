<?php

namespace App\Http\Resources;

use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\Model\SpecialistDr;
use App\Model\TelemedicineReview;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TelemedicinePaymentHistoryDataListCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $rating = TelemedicineReview::where('telemedicine_requests_id',$data->id)->first();

                $sslData = json_decode($data->payment_details,true);
                $doctor = new DoctorListDataCollections(SpecialistDr::where('id', $data->specialist_dr_id)->get());
                return [
                    //dd($data),
                    'telemedicine_request_tbl_id' => (int) $data->id,
                    'user_id' => (int) $data->user_id,
                    'total_vat' => (int) $data->total_vat,
                    'consultation_fee' => (int) $data->doctor_fee,
                    'grand_total' => (int) $data->grand_total,
                    'invoice_code' => (string) $data->code,
                    'datetime' => (string) $data->created_at,
                    'rating' => (int) isset($rating->rating) ?  $rating->rating : 0,
                    'discount_percentage' => (int) $data->discount_percentage,
                    'total_vat_pecentage' => (int) $data->total_vat_pecentage,
                    'consultation_type' => (string) $data->consultation_type,
                    'method' => $sslData['card_type'] ?? 'no data found',
                    'prescription_pdf_url' => url('prescription/download/pdf/'.$data->prescription_id),
                    'invoice_pdf_url' => url('telemedicine/invoice/download/pdf/'.$data->id),
                    'doctor' => $doctor,
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
