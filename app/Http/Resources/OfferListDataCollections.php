<?php

namespace App\Http\Resources;

use App\Model\DoctorOffer;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OfferListDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    //dd($data),
                    'offers_tbl_id' => (int) $data->id,
                    'offer_title' => (string) $data->offer_title,
                    'short_description' => (string) 'Dr. '.$data->short_description,
                    'speciality' => (string) $data->speciality->name,
                    'icon' => (string) '/uploads/special/'.$data->speciality->icon,
                    'offer_cost' => (string) $data->offer_cost,
                    'doctors' => $data->offerDoctors,
                   // 'offer_drs' => new SpecialityWiseDrsDataCollections( $data->offerDoctors),
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
