<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LabTestRequest extends Model
{
    public function patient()
    {
        return $this->belongsTo('App\Model\Patients','patient_id');

    }

    public function lab()
    {
        return $this->belongsTo('App\Model\Lab','lab_id');

    }

    public function LabSampleCollector()
    {
        return $this->belongsTo('App\Model\LabSampleCollector','lab_sample_collectors_id');

    }

}
