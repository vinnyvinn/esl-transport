<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = ['quotation_id','user_id','approved_by','invnum_id','project_id','in_quotation','supplier_id','po_date','po_no','input_currency','status'];
}
