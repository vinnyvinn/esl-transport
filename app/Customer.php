<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'Client';
    protected $primaryKey = 'DCLink';

    protected $fillable = ['DCLink','Account','Contact_Person','Name','Telephone'];
}
