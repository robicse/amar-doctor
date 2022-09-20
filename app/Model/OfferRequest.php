<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OfferRequest extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
    public function specialistDr()
    {
        return $this->belongsTo('App\Model\SpecialistDr','specialist_dr_id');

    }
    public function offer()
    {
        return $this->belongsTo('App\Model\Offer','offer_id');

    }
    public function patient()
    {
        return $this->belongsTo('App\Model\Patients','patient_id');

    }
    public function prescription()
    {
        return $this->belongsTo('App\Model\Prescriptions','prescription_id');

    }
}
