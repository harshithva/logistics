<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteList extends Model
{
    protected $guarded = [];

    public function quote(){
        return $this->belongsTo(Quote::class,'id','quote_id');
    }
}
