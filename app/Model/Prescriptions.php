<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prescriptions extends Model
{
    protected $table = "prescriptions";
    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
    public function patient(){

        return $this->belongsTo('App\Model\Patients','patient_id');
    }
    public function SpecialistDr(){
        return $this->belongsTo('App\Model\SpecialistDr','specialist_dr_id');
    }
}


