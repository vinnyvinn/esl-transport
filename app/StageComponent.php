<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StageComponent extends Model
{
    protected  $fillable = ['stage_id','name','type','required','description','components'];

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id','id');
    }
}