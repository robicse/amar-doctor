<?php

namespace App\Http\Resources;

use App\Model\SpecialistDr;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FavoriteSpDrsDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'favorite_sp_dr_tbl_id' => $data->id,
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
