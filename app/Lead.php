<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Lead extends ESLModel
{
     protected $guarded = [];

    public function quotation()
    {
        return $this->hasMany(Quotation::class, 'lead_id','id');
    }
}
