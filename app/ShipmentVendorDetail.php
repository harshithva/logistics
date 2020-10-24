<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentVendorDetail extends Model
{
    public function vendor(){
        return $this->hasOne(User::class,'id','vendor_id');
    }

    public function shipment(){
        return $this->belongsTo(Shipment::class,'id','shipment_id');
    }
}
