<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected  $fillable = ['name','contact_person','phone','email','telephone','address','physical_locatio'];
}
