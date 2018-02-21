<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgencyApproval extends Model
{
    protected  $fillable = ['user_id','quotation_id','quotation_action','remarks'];
}
