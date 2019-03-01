<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Quotation extends ESLModel
{
    protected $fillable = [ 'lead_id','user_id','service_type_id','vessel_id','status'];

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

    public function voyage()
    {
        return $this->hasOne(Voyage::class,'quotation_id','id');
    }

    public function parties()
    {
        return $this->hasOne(NotifyingParty::class,'quotation_id','id');
    }

    public function remarks()
    {
        return $this->hasMany(Remarks::class, 'quotation_id','id');
    }

    public function logs()
    {
        return $this->hasMany(QuotationLog::class,'quotation_id','id');
    }
}
