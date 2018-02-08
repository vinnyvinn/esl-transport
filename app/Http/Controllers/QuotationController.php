<?php

namespace App\Http\Controllers;

use App\GoodType;
use App\Quotation;
use App\Tariff;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function showQuotation($id)
    {
        $quote = Quotation::with(['lead','cargos.goodType','vessel','services.tariff'])->findOrFail($id);

        return view('quotation.show')
            ->withQuotation($quote)
            ->withGoodtypes(GoodType::all())
            ->withTariffs(Tariff::all()->sortBy('name'));
    }
}
