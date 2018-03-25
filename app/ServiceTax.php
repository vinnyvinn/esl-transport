<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceTax extends Model
{
    protected $table = 'TaxRate';
    protected $connection = 'sqlsrv2';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $primaryKey = 'idTaxRate';
    public $timestamps = false;

    protected $fillable = ['idTaxRate','Code','TaxRate','Description'];
}
