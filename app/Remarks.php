<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
    protected $fillable = ['user_id','remark_to','quotation_id','remark'];

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
}
