<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorExpense extends Model
{
    public function category() {
        return $this->belongsTo(User::class,'vendor_id','id');
    }
}
