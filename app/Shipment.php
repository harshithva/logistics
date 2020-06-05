<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
 protected $guarded = [];

 public function shipment(){
    return $this->belongsTo(User::class);
}
}
