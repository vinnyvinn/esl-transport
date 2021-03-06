<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Vessel extends ESLModel
{
    protected $fillable = ['lead_id','name','imo_number','country_of_discharge','country_of_loading',
        'country','call_sign',
        'loa','grt','eta','nrt','dwt','port_of_discharge','port_of_loading'];

    public function lead()
    {
        return $this->hasMany(Lead::class,'id','lead_id');
    }

    public function vDocs()
    {
        return $this->hasMany(VesselDocs::class,'vessel_id','id');
    }
}
