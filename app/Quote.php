<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $guarded = [];

    public function list(){
        return $this->hasMany(QuoteList::class,'quote_id');
    }

    public function customer(){
        return $this->belongsTo(User::class,'customer_id','id');
    }
}
