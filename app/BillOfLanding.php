<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillOfLanding extends Model
{
    protected  $fillable = ['vessel_id','time_allowed','code_name','voyage_id','quote_id',
        'Client_id','cargo_id','place_of_receipt','date_of_loading','laytime_start','consignee_id',
        'berth_number','seal_number','number_of_crane','sof_status','status','bl_number','stage'];

    public function vessel()
    {
        return $this->hasOne(Vessel::class,'id','vessel_id');
    }

    public function quote()
    {
        return $this->hasOne(Quotation::class, 'id', 'quote_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'DCLink','Client_id');
    }

    public function consignee()
    {
        return $this->hasOne(Consignee::class, 'id','consignee_id');
    }

    public function cargo()
    {
        return $this->hasMany(Cargo::class,'id','cargo_id');
    }

    public function sof()
    {
        return $this->hasMany(Sof::class,'bill_of_landing_id','id');
    }
}
