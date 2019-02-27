<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Consignee extends ESLModel
{
    protected $fillable = ['consignee_name','consignee_address','consignee_telephone','consignee_telephone'];

    public function quotation(){
        return $this->hasMany(Quotation::class,'consignee_id','id');
    }
}
