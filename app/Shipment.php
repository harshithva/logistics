<?php

namespace App;
use App\User;
use App\Package;
use App\Document;
use App\ShipmentStatus;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
 protected $guarded = [];

public function package(){
    return $this->hasMany(Package::class,'shipment_id');
}

public function document(){
    return $this->hasMany(Document::class,'shipment_id');
}

public function sender(){
    return $this->hasOne(User::class,'id','sender_id');
}

public function receiver(){
    return $this->hasOne(User::class,'id','receiver_id');
}

public function payment(){
    return $this->hasMany(Payment::class,'shipment_id');
}

public function status(){
    return $this->hasOne(ShipmentStatus::class,'shipment_id')->latest();
}

public function track(){
    return $this->hasMany(ShipmentStatus::class,'shipment_id');
}

}
