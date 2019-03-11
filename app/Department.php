<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Department extends ESLModel
{
    protected  $fillable = ['name','description'];

    public function user(){
        return $this->hasOne(Department::class,'department_id','id');
    }
}
