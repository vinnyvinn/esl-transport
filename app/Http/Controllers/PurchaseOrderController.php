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
use App\BillOfLanding;
use PDF;
use Carbon\Carbon;
use App\Mail\PurchaseOrderApproved;
use App\Mail\PurchaseOrderDisapproved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class PurchaseOrderController extends Controller
{
    public function index($id){

        $billOfLanding = BillOfLanding::with('quote')->findOrFail($id);

        $taxes = ServiceTax::all();
        $suppliers = Supplier::all();
        $services = ExtraService::all();
        return view('po.index',['suppliers'=>$suppliers, 'taxes'=>$taxes, 'services' => $services,'dms'=>$billOfLanding->id ]);
    }

    public function savePo(Request $request, $id)
    {
        $billOfLanding = BillOfLanding::with('quote')->findOrFail($id);
        $poData = $request->only(['po_date','po_no','supplier_id']);
        $supplier = Supplier::where('DCLink',$poData['supplier_id'])->first();

        $poData['quotation_id'] = $billOfLanding->quote->id;
        $poData['project_id'] = $billOfLanding->project_id;
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

        return response()->json(['created' => true, 'bill'=> $billOfLanding->project]); 
    }

    public function viewPo($id)
    {
        $po = PurchaseOrder::with('user','purchaseOrderItems','supplier')->findOrFail($id);
        return view('po.show',['po' =>  $po]);
    }

    public function approvePo($id)
    {
        $po = PurchaseOrder::with('user')->findOrFail($id);
        $po->update(['status' => 'approved']);

        Mail::to($po->user->email)
        ->send(new PurchaseOrderApproved(Auth::user(), $po->user->name, URL::previous()));

        NotificationRepo::create()->success('Purchase order approved successfully');
        return redirect()->back();
    }

    public function dissaprovePo($id)
    {
        $po = PurchaseOrder::with('user')->findOrFail($id);
        $po->update(['status' => 'dissaproved']);

        Mail::to($po->user->email)
        ->send(new PurchaseOrderDisapproved(Auth::user(), $po->user->name, URL::previous()));

        NotificationRepo::create()->success('Purchase order dissaproved successfully');
        return redirect()->back();
    }

    public function downloadPo($id){
        $po = PurchaseOrder::with('user','purchaseOrderItems','supplier')->findOrFail($id);
        $pdf = PDF::loadView('pdf.po.po-pdf',compact('po'));
        return $pdf->download($po->supplier->Name.'-'. Carbon::parse($po->created_at)->format('d-m-y').'.pdf');
    }
}
