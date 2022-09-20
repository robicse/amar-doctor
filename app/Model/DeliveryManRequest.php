<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeliveryManRequest extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
    public function deliveryMan()
    {
        return $this->belongsTo('App\Model\DeliveryMan','delivery_man_id');

    }
    public function prescription(){
        return $this->belongsTo('App\Model\Prescriptions','prescription_id');
    }
}
