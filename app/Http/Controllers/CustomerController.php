<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Customer;
use App\Quotation;
use App\Vessel;
use Esl\helpers\Constants;
use Esl\Repository\CustomersRepo;
use Esl\Repository\demoCd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index')
            ->withCustomers(Customer::simplePaginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function ajaxSearch(Request $request)
    {
        $search_result = CustomersRepo::customerInit()->searchCustomers($request->search_item, 'Client');

        $output = "";
        foreach ($search_result as $item){

            $output .= '<tr>'.
                '<td>'. ucwords($item->Name).'</td>'.
                '<td>'.ucfirst($item->Contact_Person).'</td>'.
                '<td>'.$item->Account.'</td>'.
                '<td>'.$item->Telephone.'</td>'.
                '</tr>';
        }

        return Response(['output' => $output]);
    }

    public function vesselDetails(Request $request)
    {
        $vessels = Vessel::where('name', $request->name)
            ->where('lead_id', $request->lead_id)->get();
        if (!$vessels->isEmpty()){
            $vessel = $vessels->last();
            return Response(['success' => ['vessel_name' => $vessel->name,
                'grt' => ($vessel->grt + $vessel->consignee_good), 'loa' => $vessel->loa,
                'port' => $vessel->port]]);
        }

        $vessel = Vessel::create($request->all());

        $quote = Quotation::create(['user_id'=>Auth::user()->id, 'lead_id' => $request->lead_id, 'vessel_id' => $vessel->id,
            'status' => Constants::LEAD_QUOTATION_PENDING]);

        return Response(['success' => ['redirect' => url('/quotation/'.$quote->id)]]);
    }

    public function cargoDetails(Request $request)
    {
        Cargo::create($request->all());

        return Response(['success' => ['url' => url('/')]]);
    }

    public function updateCargoDetails(Request $request)
    {
        Cargo::findOrFail($request->cargo_id)->update($request->all());
        return Response(['success' => ['url' => url('/')]]);
    }

    public function deleteCargo(Request $request)
    {
        Cargo::findOrFail($request->item_id)->delete();
        return Response(['success' => ['url' => url('/')]]);
    }
}
