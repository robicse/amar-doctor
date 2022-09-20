<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DrSpecialist extends Model
{
    protected $table = 'dr_specialities';
    public function specialistDr()
    {
        return $this->belongsTo('App\Model\SpecialistDr','specialist_dr_id');

    }
    public function speciality()
    {
        return $this->belongsTo('App\Model\Speciality','specialities_id');

    }

}
