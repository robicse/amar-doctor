<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SpecialistDr extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
