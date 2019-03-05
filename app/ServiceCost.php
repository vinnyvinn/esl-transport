<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCost extends Model
{
    protected $fillable = ['service','quotation_id','amount','description'];

    public function quotation(){
        return $this->belongsTo(Quotation::class,'quotation_id','id');
    }

    public function serviceCostDoc(){
        return $this->hasMany(ServiceCostDoc::class,'service_cost_id','id');
    }
}
