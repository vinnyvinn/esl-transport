<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationLog extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['quotation_id','details'];
}
