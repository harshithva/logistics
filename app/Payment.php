<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];


    public function shipment(){
        return $this->belongsTo(Shipment::class,'id');
    }

    public function customer(){
        return $this->belongsTo(User::class);
    }

  
}
