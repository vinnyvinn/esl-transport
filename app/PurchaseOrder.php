<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['quotation_id','user_id','approved_by','invnum_id','project_id','in_quotation','supplier_id','po_date','po_no','input_currency','status'];

    public function quotation(){
        return $this->belongsTo(Quotation::class,'quotation_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','DCLink');
    }

    public function purchaseOrderItems(){
        return $this->hasMany(PurchaseOrderItems::class,'purchase_order_id','id');
    }
}
