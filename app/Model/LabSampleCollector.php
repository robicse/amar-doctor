<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LabSampleCollector extends Model
{

    public function lab(){
        return $this->belongsTo('App\Model\Lab');
    }
}
