<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
   
    public function shipment(){
        return $this->belongsTo(Shipment::class,'shipment_id','id');
    }
}
