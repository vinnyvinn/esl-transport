<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    protected $fillable = ['quotation_id','name','voyage_no','service_code','final_destination',
        'eta','vessel_arrived','time_allowed','laytime_start'];
}
