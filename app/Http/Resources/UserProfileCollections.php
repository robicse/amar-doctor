<?php

namespace App\Http\Resources;

use App\Model\Patients;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserProfileCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    //dd($data),
                    'id' => $data->id,
                    'name' => (string) $data->name,
                    'email' => (string) $data->email,
                    'phone' => (string) $data->phone,
                    'gender' => (string) $data->gender,
                    'dob' => (string) $data->dob,
                    'avatar_original' => (string) '/uploads/profile/'.$data->avatar_original,
                    'address' => (string) $data->address,
                    'user_type' => (string) $data->user_type,
                    'district_id' => (string) $data->district->name,
                    'area' => (string) $data->area,
                    'latitude' => (double) $data->latitude,
                    'longitude' => (double) $data->longitude,
                    'balance' => (double) $data->balance,
                    'banned' => (int) $data->banned,
                    'patients' => new PatientDataCollections(Patients::where('user_id',$data->id )->get()),
                    'links' => [
                        'Edit_link' => route('user.profile.update', $data->id),
                    ]
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
