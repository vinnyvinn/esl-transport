<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class QuotationService extends ESLModel
{
    protected $fillable = ['quotation_id','tax_code','tax_description','tax_id','tax_amount',
        'tariff_id','description','grt_loa','rate','units','tax','total'];

    public function tariff()
    {
        return $this->hasOne(Tariff::class,'id','tariff_id');
    }
}
