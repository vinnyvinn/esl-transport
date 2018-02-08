<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodType extends Model
{
    protected  $fillable = ['name','description','uom'];
}
