<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExperiencesDataCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'experience_tbl_id' => $data->id,
                    'specialist_dr_id' => (int) $data->specialist_dr_id,
                    'department' => (string) $data->department,
                    'institute_name' => (string) $data->institute_name,
                    'designation' => (string) $data->designation,
                    'employment_period_from' => (string) $data->employment_period_from,
                    'employment_period_to' => (string) $data->employment_period_to,
                    'period' => (string) $data->period,
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
