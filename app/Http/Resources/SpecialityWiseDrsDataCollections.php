<?php

namespace App\Http\Resources;

use App\Model\SpecialistDr;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SpecialityWiseDrsDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                //dd(SpecialistDr::where('id',$data->specialist_dr_id)->get());
                return [
                    'specialist_dr_id' => $data->specialist_dr_id,
                    'doctors' => new DoctorListDataCollections(SpecialistDr::where('id',$data->specialist_dr_id)->get()),
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
