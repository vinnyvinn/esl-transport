<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Consignee;
use App\Customer;
use App\Quotation;
use App\Vessel;
use App\Voyage;
use Carbon\Carbon;
use Validator;
use Esl\helpers\Constants;
use Esl\Repository\CustomersRepo;
use Esl\Repository\NotificationRepo;
use function GuzzleHttp\Promise\all;
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
        foreach ($search_result as $item) {

            $output .= '<tr>' .
            '<td>' . ucwords($item->Name) . '</td>' .
            '<td>' . ucfirst($item->Contact_Person) . '</td>' .
            '<td>' . $item->Account . '</td>' .
            '<td>' . $item->Telephone . '</td>' .
            '<td><div class="row">' .
            '<button class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg' . $item->DCLink . '"><i class="fa fa-plus"></i></button>' .

            '<div class="modal fade bs-example-modal-lg' . $item->DCLink . '" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">' .
            '<div class="modal-dialog modal-lg">' .
            '<div class="modal-content">' .
            ' <div class="modal-header">' .
            '<h4 class="modal-title" id="myLargeModalLabel">Add As Lead</h4>' .
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' .
            ' </div>' .
            '<div class="modal-body">' .
            '<div class="col-12">' .
            '<div class="card">' .
            '<div class="card-body">' .
            '<form class="form-material m-t-40" action="' . route('leads.store') . '" method="post">' .
            csrf_field() .
            '<div class="row">' .
            '<div class="col-sm-6">' .
            '<div class="form-group">' .
            '<label for="name">Name <span class="help">(Customer or Company Name)</span></label>' .
            '<input type="text" value="' . ucwords($item->Name) . '" required id="name" name="name" class="form-control" placeholder="Name">' .

            '</div>' .
            '<div class="form-group">' .
            '<label for="contact_person">Contact Person</label>' .
            '<input type="text" required id="contact_person" value="' . ucfirst($item->Contact_Person) . '" name="contact_person" class="form-control" placeholder="Contact Person">' .

            '</div>' .
            '<div class="form-group">' .
            '<label for="email">Email </label>' .
            '<input type="email" required id="email" name="email" class="form-control" placeholder="Email">' .

            '</div>' .
            '<div class="form-group">' .
            '<label for="phone">Phone </label>' .
            '<input type="text" required id="phone" name="phone" class="form-control" placeholder="Phone">' .

            '</div>' .
            '</div>' .
            '<div class="col-sm-6">' .
            '<div class="form-group">' .
            '<label for="telephone">Telephone </label>' .
            '<input type="text" id="telephone" name="telephone" value="' . $item->Telephone . '" class="form-control" placeholder="Telephone">' .

                '</div>' .
                '<div class="form-group">' .
                '<label for="address">Address </label>' .
                '<input type="text" id="address" name="address" class="form-control" placeholder="Address">' .

                '</div>' .
                '<div class="form-group">' .
                '<label for="location">Physical Location </label>' .
                '<input type="text" id="location" name="location" class="form-control" placeholder="Physical Location ">' .

                '</div>' .
                '<div class="form-group">' .
                '<label for="currency">Select Currency </label>' .
                '<select name="currency" id="currency" class="form-control select2">' .
                '<option value="">Select Currency</option>';
            foreach (json_decode(\Esl\helpers\Constants::CURRENCY_ARRAY) as $value) {
                $output = $output . '<option value="' . $value->code . '">' . $value->name_plural . '</option>';
            }
            $output = $output . '</select>' .
                ' </div>' .
                '<div class="form-group">' .
                '<br>' .
                '<input class="btn btn-block btn-primary" type="submit" value="Save">' .
                '</div>' .
                '</div>' .
                '</div>' .
                '</form>' .
                '</div>' .
                '</div>' .
                '</div>' .
                '</div>' .
                '<div class="modal-footer">' .
                '<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>' .
                '</div>' .
                ' </div>' .
                ' </div>' .
                '</div>' .
                '</div></td>' .
                '</tr>';
        }

        return Response(['output' => $output]);
    }

    public function vesselDetails(Request $request)
    {
        $vessel = null;
        $vessels = Vessel::where('name', $request->name)
            ->where('lead_id', $request->lead_id)->get();
        if (!$vessels->isEmpty()) {
            $vessel = $vessels->last();
            $vessel->update($request->all());// update if vessel exists
        } else {
            $vessel = Vessel::create($request->all());//create a new vessel
        }

        $quote = new Quotation();
        $quote->user_id = Auth::user()->id;
        $quote->lead_id = $request->lead_id;
        $quote->vessel_id = $vessel->id;
        $quote->consignee_id = $request->consignee_id;
        $quote->status = Constants::LEAD_QUOTATION_PENDING;
        $quote->save();// save quotation

        $data = $request->all();

        $cargo = new Cargo($data);
        $voyage = new Voyage($data);

        $quote->cargos()->save($cargo);//save quote cargo details
        $quote->voyage()->save($voyage);// save voyage details

        // NotificationRepo::create()->success('Quotation generated successfully');
        // return Response(['success' => ['redirect' => url('/quotation/' . $quote->id)]]);
        return redirect()->route('show-quotation',['id'=>$quote->id]);
    }

    public function oVesselDetails(Request $request)
    {

        $vessels = Vessel::where('name', $request->name)
            ->where('lead_id', $request->lead_id)->get();
        if (!$vessels->isEmpty()) {
            $vessel = $vessels->last();
            $vessel->update($request->all());

            NotificationRepo::create()->success('updated successfully');

            return Response(['success' => ['vessel_name' => $vessel->name,
                'grt' => ($vessel->grt + $vessel->consignee_good), 'loa' => $vessel->loa,
                'port' => $vessel->port_of_loading]]);
        }

        $vessel = Vessel::create($request->all());

        $quote = Quotation::create(['user_id' => Auth::user()->id,
            'service_type_id' => $request->type,
            'lead_id' => $request->lead_id, 'vessel_id' => $vessel->id,
            'status' => Constants::LEAD_QUOTATION_PENDING]);

        NotificationRepo::create()->success('Quotation generated successfully');

        return Response(['success' => ['redirect' => url('/quotation/' . $quote->id)]]);
    }

    public function cargoDetails(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);
        $cargo = new Cargo($request->all());
        // $data['manifest_number'] = count(Cargo::all()) . '/' . Date('Y');
        // $data['seal_no'] = count(Cargo::all()) . '/' . Date('Y');
        $quotation->cargos()->save($cargo);
        NotificationRepo::create()->success('Cargo details added successfully');

        // return Response(['success' => ['url' => url('/')]]);
        return redirect()->back();
    }

    public function voyageDetails(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);

        $validatedData = $request->validate([
            'voyage_name' => 'required',
            'voyage_no' => 'required',
            'internal_voyage_no' => 'required',
            'service_code' => 'required',
            'eta' => 'required',
            'final_destination' => 'required'
        ]);

        $voyage = new Voyage();
        $voyage->voyage_name = $request->voyage_name;
        $voyage->voyage_no = $request->voyage_name;
        $voyage->internal_voyage_no = $request->internal_voyage_no;
        $voyage->service_code = $request->service_code;
        $voyage->eta = $request->eta;
        $voyage->final_destination = $request->final_destination;

        $quotation->voyage()->save($voyage);

        NotificationRepo::create()->success('Voyage details added successfully');

        return redirect()->back();

        // return Response(['success' => ['redirect' => url('/quotation/' . $request->quotation_id)]]);
    }

    public function updateCargoDetails(Request $request, $id)
    {
        Cargo::findOrFail($id)->update($request->all());
        NotificationRepo::create()->success('Cargo details updated successfully');
        return redirect()->back();
        // return Response(['success' => ['url' => url('/')]]);
    }

    public function deleteCargo(Request $request)
    {
        Cargo::findOrFail($request->item_id)->delete();
        NotificationRepo::create()->success('Cargo details deleted successfully');
        return Response(['success' => ['url' => url('/')]]);
    }

    public function consigneeDetails(Request $request,$id)
    {
        $quotation = Quotation::findOrFail($id);

        $validatedData = $request->validate([
            'consignee_id' => 'required'
        ]);

        $quotation->consignee_id = $request->consignee_id;
        $updateSuccess = $quotation->save();

        if($updateSuccess){
            NotificationRepo::create()->success('Consignee details added successfully');
        }else{
            NotificationRepo::create()->error('Unable to add consignee. Try again Later');
        }

        return redirect()->back();
       
        // return Response(['success' => ['redirect' => url('/quotation/' . $request->quotation_id)]]);

    }
}
