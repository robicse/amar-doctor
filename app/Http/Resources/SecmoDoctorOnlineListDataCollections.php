<?php

namespace App\Http\Resources;

use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SecmoDoctorOnlineListDataCollections extends ResourceCollection
{
    public $lat = 0;
    public $lang =0;
    public function toArray($request)
    {
        $this->lat = $request->latitude;
        $this->lang = $request->longitude;
        return [
            'data' => $this->collection->map(function($data) {
                return [

                    'secmo_drs_tbl_id' => (int) $data->id,
                    'user_tbl_id' => (int) $data->user_id,
                    'full_name' => (string) $data->user->name,
                    'avatar_original' => (string) '/uploads/profile/'.$data->user->avatar_original,
                    'latitude' => (string) $data->user->latitude,
                    'longitude' => (string) $data->user->longitude,
                    //'distance' => GetDistance('https://barikoi.xyz/v1/api/distance/MjMzNTpTWlBLSkRHUTRZ/'.$this->lang .','.$this->lat.'/'.$data->user->longitude.','.$data->user->latitude),

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
