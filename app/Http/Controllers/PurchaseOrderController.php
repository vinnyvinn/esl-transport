<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Esl\Repository\NotificationRepo;
use Esl\helpers\Constants;
use App\Quotation;
use App\Supplier;
use App\ServiceTax;
use App\ExtraService;
use App\PurchaseOrder;
use App\PurchaseOrderItems;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{
    public function index($id){

        $quotation = Quotation::findOrFail($id);
        $taxes = ServiceTax::all();
        $suppliers = Supplier::all();
        $services = ExtraService::all();
        return view('po.index',['suppliers'=>$suppliers, 'taxes'=>$taxes, 'services' => $services, 'quotation'=>$id, ]);
    }

    public function savePo(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);
        $poData = $request->only(['po_date','po_no','supplier_id']);
        $supplier = Supplier::where('DCLink',$poData['supplier_id'])->first();

        $poData['quotation_id'] = $id;
        $poData['user_id'] = Auth::user()->id;
        $poData['status'] = Constants::LEAD_QUOTATION_PENDING;
        $poData['input_currency'] = $supplier -> iCurrencyID > 0 ? 'USD' : 'KSH';

        $purchaseOrder = new PurchaseOrder($poData);
        $purchaseOrder->save();

        $items = collect($request->purchase_order_items);

        if($items->count() > 0){
            $items->transform(function($item){
                return new PurchaseOrderItems($item);
            });
           
            $purchaseOrder->purchaseOrderItems()->saveMany($items);
        };

        // NotificationRepo::create()->success('Purchase order generated successfully');
        // return redirect()->back();

        return response()->json(['created' => true, 'id' => $purchaseOrder->id ]);
        
    }
}
