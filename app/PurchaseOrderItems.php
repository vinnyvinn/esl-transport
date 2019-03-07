<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItems extends Model
{
    protected $fillable = ['purchase_order_id','service','description','quantity','rate','tax'];

    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class,'purchase_order_id','id');
    }
}
