<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class EducationalQualification extends Model
{
    public function degree()
    {
        return $this->belongsTo('App\Model\Degree','degree_id');

    }
}
