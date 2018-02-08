<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = ['name','lead_id','quotation_id','good_type_id','discharge_rate',
        'port_stay','shipping_type','description','package','weight',
        'total_package','shipper','notifying_address','remarks'];

    public function quotation()
    {
        return $this->hasOne(Quotation::class, 'id', 'quotation_id');
    }

    public function goodType()
    {
        return $this->hasOne(GoodType::class, 'id','good_type_id');
    }
}
