<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignee extends Model
{
    protected $fillable = ['name','quotation_id','email','details'];

}
