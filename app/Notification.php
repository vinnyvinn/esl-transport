<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['title','text','link','user_id','status','department_id'];
}
