<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Consignee extends ESLModel
{
    protected $fillable = ['name','quotation_id','email','details'];

}
