<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sof extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['bill_of_landing_id','from','to','crane_working','remarks'];
}
