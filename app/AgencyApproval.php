<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgencyApproval extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected  $fillable = ['user_id','quotation_id','quotation_action','remarks'];
}
