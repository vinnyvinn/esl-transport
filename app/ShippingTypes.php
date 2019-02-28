<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingTypes extends Model
{
    protected $fillable=['shipping_type_name','shipping_type_description'];

    public function cargo(){
        return $this->hasMany(Cargo::class,'shipping_type','id');
    }
}
