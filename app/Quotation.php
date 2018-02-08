<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [ 'lead_id','user_id','vessel_id','status'];

    public function vessel()
    {
        return $this->hasOne(Vessel::class, 'id','vessel_id');
    }
    public function lead()
    {
        return $this->hasOne(Lead::class, 'id','lead_id');
    }

    public function services()
    {
        return $this->hasMany(QuotationService::class,'quotation_id','id');
    }

    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'quotation_id','id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
