<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $fillable = ['name'];

    public function cargo(){
        return $this->hasMany(Cargos::class,'container_id','id');
    }
}
