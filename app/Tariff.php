<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['type','name','unit_value','unit_type','rate','unit'];
}
