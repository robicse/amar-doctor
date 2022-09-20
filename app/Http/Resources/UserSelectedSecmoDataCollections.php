<?php

namespace App\Http\Resources;

use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserSelectedSecmoDataCollections extends ResourceCollection
{
    public $lat = 0;
    public $lang =0;
    public function toArray($request)
    {
        //dd($request->all());
        $this->lat = $request->latitude;
        $this->lang = $request->longitude;
        $this->user_tbl_id = $request->user_tbl_id;
        return [
            'data' => $this->collection->map(function($data) {
                $user = User::find( $this->user_tbl_id);
                return [

                    'secmo_drs_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'full_name' => (string) 'Dr. '.$data->user->name,
                    'phone' => (string) $data->user->phone,
                    'bmdc_number' => (string) $data->bmdc_number,
                    'designation' => (string) $data->professional_degree,
                    'avatar_original' => (string) '/uploads/profile/'.$data->user->avatar_original,
                    'latitude' => (string) $data->user->latitude,
                    'longitude' => (string) $data->user->longitude,
                    'user_address' => GetAddress($user->longitude,$user->latitude),
                    'secmo_address' => GetAddress($this->lang,$this->lat),
                    'distance' => GetDistance('https://barikoi.xyz/v1/api/distance/MjMzNTpTWlBLSkRHUTRZ/'.$this->lang .','.$this->lat.'/'.$user->longitude.','.$user->latitude),
                    'rating' =>(double) secmoRating($data->id)
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
