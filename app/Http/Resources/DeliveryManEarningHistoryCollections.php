<?php

namespace App\Http\Resources;

use App\Model\DeliveryManRequest;
use App\Model\DrSpecialist;
use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\HomeServiceRequest;
use App\Model\Patients;
use App\Model\TelemedicineRequest;
use App\User;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class DeliveryManEarningHistoryCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                //dd($data);
                return [
                   'total' =>  DB::table('delivery_man_requests')
                       ->where('delivery_man_id',  $data->delivery_man_id)
                       ->where('status', 'complete')->sum('delivery_man_cost'),
                   'date' => $data->date,
                   'sum_total_amount' => $data->sum_total_amount,
                    'details' => new DeliveryManEarningHistoryDetailsCollections(DeliveryManRequest::whereDate('created_at',$data->date)->where('delivery_man_id', $data->delivery_man_id)->where('status', 'complete')->get()),
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
