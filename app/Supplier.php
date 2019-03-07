<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'Vendor';
    protected $connection = 'sqlsrv2';
    // protected $dateFormat = 'Y-m-d H:i:s';
    // protected $primaryKey = 'DCLink';
    // public $timestamps = false;

    public function purchaseOrder(){
        return $this->hasMany(PurchaseOrder::class,'supplier_id','id');
    }
}
