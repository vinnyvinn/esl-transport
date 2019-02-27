<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CargoTypes extends Model
{
    protected $fillable = ['name', 'description'];

    public function cargo(){
        return $this->hasMany(Cargo::class,'type','id');
    }
}
