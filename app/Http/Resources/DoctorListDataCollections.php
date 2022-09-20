<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\Model\SpecialistDr;
use App\Model\TelemedicineRequest;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DoctorListDataCollections extends ResourceCollection
{
    public function toArray($request)
    {

        return [
            'data' => $this->collection->map(function($data) {
                //dd(isset($data->specialist_dr_id) ? $data->specialist_dr_id : $data->id);
                //$spDr = SpecialistDr::find( isset($data->specialist_dr_id) ? $data->specialist_dr_id : $data->id );
                $spDr = SpecialistDr::find($data->id );

               $user =  User::find($spDr->user_id);


                return [
                    'specialist_drs_tbl_id' => (int) $spDr->id,
                    'user_tbl_id' => (int) $spDr->user_id,
                    'full_name' => (string) $spDr->title.' '.$user->name,
                    'gender' => (string) $user->gender,
                    'professional_derees' => (string) $spDr->professional_derees,
                    'experience' => (string) $spDr->experience,
                    'current_employment' => (string) $spDr->current_employment,
                    'consultation_fee' => (string) $spDr->consultation_fee,
                    'isDiscount' => spDoctorIsDiscount($spDr->id),
                    'discount_percentage' => $spDr->discount_percentage,
                    'discountFee' => (int) spDoctorIsDiscount($spDr->id) == 1 ? (int) spDoctorDiscountCalculation($spDr->id) : 0,
                    'avatar_original' => (string) '/uploads/profile/'.$spDr->user->avatar_original,
                    'rating' => (double) specialistDoctorRating($spDr->id),
                    'availability' => $spDr->availability,
                    'total_patients_attend' => (int) TelemedicineRequest::where('specialist_dr_id', $spDr->id)->where('status', 'complete')->count(),
                    'is_online' => (int) $spDr->is_online,
                    'is_approve' => (int) $spDr->is_approved,
                    'is_active' => (int) $spDr->is_active,
                    'bmdc' => (string) $spDr->bmdc,
                    'doctor_code' => (string) $spDr->doctor_code,
                    'specialities' => new DoctorSpecialityDataCollections(DrSpecialist::where('specialist_dr_id', $spDr->id)->get()),
                    'links' => [
                        'dr_details_link' => url('api/encryption/specialist/doctors/details/'.$spDr->id),
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
