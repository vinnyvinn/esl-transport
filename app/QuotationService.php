<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationService extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['quotation_id','tariff_id','description',
        'grt_loa','rate','units','tax','total'];

    public function tariff()
    {
        return $this->hasOne(Tariff::class,'id','tariff_id');
    }
}
