<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{

    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['name','service','description'];

    public function sComments()
    {
        return $this->hasMany(StageComment::class, 'stage_id', 'id');
    }

    public function components()
    {
        return $this->hasMany(StageComponent::class, 'stage_id', 'id');
    }
}
