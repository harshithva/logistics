<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentStatus extends Model
{
    
    public function shipment(){
        return $this->belongsTo(Shipment::class,'id');
    }

    public function customer(){
        return $this->belongsTo(User::class);
    }

}
