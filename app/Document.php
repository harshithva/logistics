<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['title','document'];

    public function shipment(){
        return $this->belongsTo(Shipment::class,'shipment_id','id');
    }
}
