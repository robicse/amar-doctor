<?php

namespace App\Http\Resources;

use App\Model\EducationalQualification;
use App\Model\Experience;
use App\Model\Patients;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewDataListCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    //dd($data),
                    'review_tbl_id' => (int) $data->id,
                    'user_full_name' => (string) $data->user->name,
                    'avatar_original' => (string) '/uploads/profile/'.$data->user->avatar_original,
                    'rating' => (string) $data->rating,
                    'comment' =>  $data->comment,
                    'date' =>  $data->created_at->format('Y-m-d'),
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
