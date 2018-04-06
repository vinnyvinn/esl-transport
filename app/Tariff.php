<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Tariff extends ESLModel
{
//    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['type','name','unit_value','unit_type','rate','unit'];
}
