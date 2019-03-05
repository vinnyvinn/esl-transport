<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundDoc extends Model
{
    protected $fillable = ['fund_id','doc_path','name'];

    public function funds(){
        return $this->belongsTo(Fund::class,'fund_id','id');
    }
}
