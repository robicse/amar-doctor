<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    public function specialistDr()
    {
        return $this->belongsTo('App\Model\SpecialistDr','specialist_dr_id');

    }
}
