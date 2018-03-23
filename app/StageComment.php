<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StageComment extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['user_id','stage_id','comments'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
