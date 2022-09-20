<?php

namespace App\Http\Resources;

use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use App\Model\TelemedicineRequest;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class SpDrEarningHistoryCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                   'total' =>  DB::table('telemedicine_requests')
                       ->where('specialist_dr_id',  $data->specialist_dr_id)
                       ->where('status', 'complete')->sum('specialist_dr_amount'),
                   'date' => $data->date,
                   'sum_total_amount' => $data->sum_total_amount,
                    'details' => new SpDoctorEarningHistoryDetailsCollections(TelemedicineRequest::whereDate('created_at',$data->date)->where('specialist_dr_id', $data->specialist_dr_id)->where('status', 'complete')->get()),
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
