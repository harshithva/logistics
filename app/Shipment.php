<?php

namespace App;
use App\User;
use App\Package;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
 protected $guarded = [];

 public function shipment(){
    return $this->belongsTo(User::class);
}

public function package(){
    return $this->hasMany(Package::class,'shipment_id');
}

public function customer(){
    return $this->hasOne(User::class,'id');
}

public function receiver(){
    return $this->hasOne(User::class,'receiver_id');
}

}
