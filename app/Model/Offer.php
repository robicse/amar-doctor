<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function speciality()
    {
        return $this->belongsTo('App\Model\Speciality','specialty_id');

    }

    public function offerDoctors()
    {
        return $this->hasMany('App\Model\DoctorOffer','offer_id');

    }
}
