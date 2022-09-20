<?php

namespace App\Http\Resources;

use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserSelectedDeliveryManDataCollections extends ResourceCollection
{
    public $lat = 0;
    public $lang =0;
    public function toArray($request)
    {
        //dd($request->all());
        $this->lat = $request->latitude;
        $this->lang = $request->longitude;
        return [
            'data' => $this->collection->map(function($data) {
                return [

                    'delivery_man_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'full_name' => (string) $data->user->name,
                    'phone' => (string) $data->user->phone,
                    'mobile_bank_number' => (string) $data->mob_bank_number,
                    'avatar_original' => (string) '/uploads/profile/'.$data->user->avatar_original,
                    'latitude' => (string) $data->user->latitude,
                    'longitude' => (string) $data->user->longitude,
                    'user_address' => GetAddress($this->lang,$this->lat),
                    'delivery_man_address' => $data->user->latitude ? GetAddress($data->user->longitude,$data->user->latitude):null,
                    'distance' => $data->user->latitude ? GetDistance('https://barikoi.xyz/v1/api/distance/MjMzNTpTWlBLSkRHUTRZ/'.$this->lang .','.$this->lat.'/'.$data->user->longitude.','.$data->user->latitude): null,
                    'rating' =>(double) 3.5
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
