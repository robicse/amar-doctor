<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TelemedicineReview extends Model
{
    protected $table = 'telemedicine_service_reviews';

    public function SpecialistDr(){
        return $this->belongsTo('App\Model\SpecialistDr','specialist_dr_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
