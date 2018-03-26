<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['extra_service_type_id','name','rate','unit'];

    public function type()
    {
        return $this->hasOne(ExtraServiceType::class,'id','extra_service_type_id');
    }
}
