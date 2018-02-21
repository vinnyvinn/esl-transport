<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{

    protected $fillable = ['name','description'];

    public function sComments()
    {
        return $this->hasMany(StageComment::class, 'stage_id', 'id');
    }

    public function components()
    {
        return $this->hasMany(StageComponent::class, 'stage_id', 'id');
    }
}
