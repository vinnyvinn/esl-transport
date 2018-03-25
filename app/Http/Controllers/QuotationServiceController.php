<?php

namespace App\Http\Controllers;

use App\QuotationService;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\QuotationServiceRepo;
use Illuminate\Http\Request;

class QuotationServiceController extends Controller
{
    public function addQuotationService(Request $request)
    {
        $data = $request->all();

        foreach ($data['service'] as $datum) {
            QuotationService::create([
                'quotation_id' => $data['quotation'],
                'tariff_id' => $datum['tariff_id'],
                'description' => $datum['description'],
                'tax_code' => $datum['tax_code'],
                'tax_description' => $datum['tax_description'],
                'tax_id' => $datum['tax_id'],
                'tax_amount' => $datum['tax_amount'],
                'grt_loa' => $datum['grt_loa'],
                'rate' => $datum['rate'],
                'units' => $datum['units'],
                'tax' => $datum['tax_amount'],
                'total' => (float)$datum['total']
            ]);
        }

        return Response(['success' => $this->quotationServices($data['quotation'])]);

    }

    public function deleteQuotationService(Request $request)
    {
        QuotationService::findOrFail($request->service_id)->delete();
        return Response(['success' => $this->quotationServices($request->quotation_id)]);
    }

    public function updateService(Request $request)
    {
        $tax = json_decode($request->tax);
        QuotationService::findOrFail($request->service_id)
        ->update([
            'tax_code' => $tax->Code,
            'tax_description' => $tax->Description,
            'tax_id' => $tax->idTaxRate,
            'tax_amount' => (($tax->TaxRate) * ($request->rate * $request->units) / 100),
            'description' => $request->description,
            'grt_loa' => $request->grt_loa,
            'rate' => $request->rate,
            'units' => $request->units,
            'tax' => (($tax->TaxRate) * ($request->rate * $request->units) / 100),
            'total' => ((($tax->TaxRate) * ($request->rate * $request->units) / 100) + ($request->rate * $request->units))
        ]);



        return Response(['success' => 'done']);
    }

    private function quotationServices($id)
    {
        $result = QuotationServiceRepo::init()->getQuotationServices($id);

        $output = "";
        foreach ($result['services'] as $item){
            $output .= '<tr>'.
                '<td>'. ucwords($item->description).'</td>'.
                '<td class="text-right">'.$item->grt_loa.'</td>'.
                '<td class="text-right">'.$item->rate.'</td>'.
                '<td class="text-right">'.$item->units.'</td>'.
                '<td class="text-right">'.$item->tax.'</td>'.
                '<td class="text-right">'.number_format($item->total).'</td>'.
                '<td class="text-right"><button onclick="deleteService('.$item->id.')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>'.
                '</tr>';
        }

        unset($result['services']);
        $result['services'] = $output;

        return $result;
    }
}
