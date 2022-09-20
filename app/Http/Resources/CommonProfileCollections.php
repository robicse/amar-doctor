<?php

namespace App\Http\Resources;

use App\Model\DeliveryMan;
use App\Model\Experience;
use App\Model\Patients;
use App\Model\SecmoDr;
use App\Model\SpecialistDr;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommonProfileCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $doctorDetails = null;
                $name = null;
                if ($data->user_type == 'specialist_dr'){
                   $name =  (!empty($data->specialistDr) ? $data->specialistDr->title : "Dr. ").' '.$data->name;
                    $doctorDetails = new DoctorDetailsDataCollections(SpecialistDr::where('user_id', $data->id)->get());
                }elseif($data->user_type == 'secmo_dr') {
                    $name = $data->name;
                    $doctorDetails = new SecmoDoctorDetailsDataCollections(SecmoDr::where('user_id', $data->id)->get());
                }elseif ($data->user_type == 'delivery_man') {
                    $name = $data->name;
                    $doctorDetails = new DeliveryManDetailsDataCollections(DeliveryMan::where('user_id', $data->id)->get());
                }
                return [
                    //dd($data),
                    'user_tbl_id' => $data->id,
                    'full_name' => (string) $name,
                    'email' => (string) $data->email,
                    'phone' => (string) $data->phone,
                    'gender' => (string) $data->gender,
                    'dob' => (string) $data->dob,
                    'avatar_original' => (string) '/uploads/profile/'.$data->avatar_original,
                    'nid_pp_front' => (string) '/uploads/nid/'.$data->nid_pp_front,
                    'nid_pp_back' => (string) '/uploads/nid/'.$data->nid_pp_back,
                    'address' => (string) $data->address,
                    'user_type' => (string) $data->user_type,
                    'district_id' => (string) !empty($data->district) ? $data->district->id : "no district inserted!",
                    'area' => (string) $data->area,
                    'latitude' => (double) $data->latitude,
                    'longitude' => (double) $data->longitude,
                    'balance' => (double) $data->balance,
                    'banned' => (int) $data->banned,
                    'details' => $doctorDetails,
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
