<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VesselDocs extends Model
{
    protected $fillable = ['vessel_id','doc_path','name'];
}
