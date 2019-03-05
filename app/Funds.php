<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funds extends Model
{
    protected $fillable = ['employee_id','quotation_id','amount','currency','payment_type','deadline','reason'];

    public function quotation(){
        return $this->belongsTo(Quotation::class,'quotation_id','id');
    }

    public function fundDoc(){
        return $this->hasMany(FundDoc::class,'fund_id','id');
    }
}
