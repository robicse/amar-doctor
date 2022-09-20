<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DmServiceReview extends Model
{
    public function deliveryMan(){
        return $this->belongsTo('App\Model\DeliveryMan','delivery_man_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
