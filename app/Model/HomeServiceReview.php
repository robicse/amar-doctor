<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HomeServiceReview extends Model
{
    public function secmo_dr(){
        return $this->belongsTo('App\Model\SecmoDr','secmo_dr_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
