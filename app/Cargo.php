<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Cargo extends ESLModel
{
    protected $fillable = ['cargo_name','lead_id','quotation_id','good_type_id','manifest_number','type','seal_no',
        'container_id','case_qty','t_net_weight',
        't_gross_weight','shipping_line','discharge_rate',
        'port_stay','shipping_type','description','package','weight',
        'total_package','shipper','notifying_address','remarks','consignee_name','consignee_telephone',
    'consignee_email','consignee_address'];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id', 'id');
    }

    public function goodType()
    {
        return $this->hasOne(GoodType::class, 'id','good_type_id');
    }

    public function cargoTypes(){
        return $this->belongsTo(CargoTypes::class,'type','id');
    }

    public function container(){
        return $this->belongsTo(Container::class,'container_id','id');
    }

    public function shippingTypes(){
        return $this->belongsTo(ShippingTypes::class,'shipping_type','id');
    }
}







