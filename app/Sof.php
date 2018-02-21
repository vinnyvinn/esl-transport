<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sof extends Model
{
    protected $fillable = ['bill_of_landing_id','from','to','crane_working','remarks'];
}
