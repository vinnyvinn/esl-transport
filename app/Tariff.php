<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = ['type','name','unit_value','unit_type','rate','unit'];
}
