<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    public function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }
}
