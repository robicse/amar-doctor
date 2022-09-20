<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeliveryMan extends Model
{
    protected $table = 'delivery_mans';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
