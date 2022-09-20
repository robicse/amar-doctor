<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\Model\TelemedicineRequest;
use App\Model\TelemedicineReview;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DoctorDetailsDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    //dd($data),
                    'specialist_drs_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'about' => (string) $data->about,
                    'professional_derees' => (string) $data->professional_derees,
                    'bmdc' => (string) $data->bmdc,
                    'experience' => (string) $data->experience,
                    'current_employment' => (string) $data->current_employment,
                    'doctor_code' => (string) $data->doctor_code,
                    'consultation_fee' => (string) $data->consultation_fee,
                    'follow_up_fee' => (string) $data->follow_up_fee,
                    'isDiscount' => spDoctorIsDiscount($data->id),
                    'discountFee' => (int) spDoctorIsDiscount($data->id) == 1 ? (int) spDoctorDiscountCalculation($data->id) : 0,
                    'follow_up_within' => $data->follow_up_within,
                    'availability' => $data->availability,
                    'consultation_time' => (string) $data->consultation_time,
                    'discount_percentage' => (double) $data->discount_percentage,
                    'discount_expiry' => (double) $data->discount_expiry,
                    'acc_holder_name' => (double) $data->acc_holder_name,
                    'account_number' => (int) $data->account_number,
                    'mob_bank_name' => (int) $data->mob_bank_name,
                    'mob_bank_number' => (int) $data->mob_bank_number,
                    'bank_name' => (int) $data->bank_name,
                    'total_patients_attend' => (int) 45,
                    'is_online' => (int) $data->is_online,
                    'is_active' => (int) $data->is_active,
                    'is_approve' => (int) $data->is_approved,
                    'rating' => (double) specialistDoctorRating($data->id),
                    'reviews' => new ReviewDataListCollections(TelemedicineReview::where('specialist_dr_id', $data->id)->get()),
                    'specialities' => new DoctorSpecialityDataCollections(DrSpecialist::where('specialist_dr_id', $data->id)->get()),
                    'experiences' => new ExperiencesDataCollections(Experience::where('specialist_dr_id',$data->id )->get()),
                    'educational_qualification' => new EducationalQualificationDataCollections(EducationalQualification::where('specialist_dr_id',$data->id )->get()),

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
