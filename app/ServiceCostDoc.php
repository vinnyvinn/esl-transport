<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCostDoc extends Model
{
    protected $fillable = ['service_cost_id','doc_path','name'];

    public function serviceCost(){
        return $this->belongsTo(ServiceCost::class,'service_cost_id','id');
    }
}
