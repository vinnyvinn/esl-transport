<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotifyingParty extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['quotation_id','emails'];
}
