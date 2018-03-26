<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraServiceType extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['name','description'];
}
