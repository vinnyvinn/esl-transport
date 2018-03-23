<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['user_id','remark_to','quotation_id','remark'];

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
}
