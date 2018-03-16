<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifyingParty extends Model
{
    protected $fillable = ['quotation_id','emails'];
}
