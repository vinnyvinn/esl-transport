<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignee extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['name','quotation_id','email','details'];

}
