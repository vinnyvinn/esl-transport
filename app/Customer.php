<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'Client';
    protected $connection = 'sqlsrv2';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $primaryKey = 'DCLink';
    public $timestamps = false;

    protected $fillable = ['DCLink','Account','Physical1','Physical2','Email','Contact_Person','Name','Telephone'];
}