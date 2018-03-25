<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected  $fillable = ['name','contact_person','phone','currency',
        'email','telephone','address','location'];

    public function quotation()
    {
        return $this->hasMany(Quotation::class, 'lead_id','id');
    }
}
