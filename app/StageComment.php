<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StageComment extends Model
{
    protected $fillable = ['user_id','stage_id','comments'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
