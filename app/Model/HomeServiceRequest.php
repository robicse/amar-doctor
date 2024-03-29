<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HomeServiceRequest extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
    public function secmo_dr(){
        return $this->belongsTo('App\Model\SecmoDr','secmo_dr_id');
    }
    public function patient(){
        return $this->belongsTo('App\Model\Patients','patient_id');
    }
    public function SpecialistDr(){
        return $this->belongsTo('App\Model\SpecialistDr','specialist_dr_id');
    }
    public function prescription(){
        return $this->belongsTo('App\Model\Prescription','prescription_id');
    }
}
