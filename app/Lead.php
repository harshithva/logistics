<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'email',
        'name',
        'type',
        'contact',
        'source',
        'region',
        'country',
        'potential_opportunity',
        'chance_of_sale',
        'forecast_close',
        'weighted_forecast',
    ];

}
