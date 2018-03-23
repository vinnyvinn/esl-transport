<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VesselDocs extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['vessel_id','doc_path','name'];
}
