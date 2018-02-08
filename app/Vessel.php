<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    protected $fillable = ['lead_id','name','imo_number','country','call_sign',
        'loa','grt','consignee_good','nrt','dwt','port'];
}
