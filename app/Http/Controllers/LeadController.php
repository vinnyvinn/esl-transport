<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Quotation;
use Carbon\Carbon;
use Esl\Repository\CustomersRepo;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leads.index')
            ->withLeads(Lead::simplePaginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Lead::create($request->all());
        return redirect('/leads');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        return view('leads.show')
            ->withLead($lead)
            ->withQuotations(Lead::with(['quotation.vessel'])->findOrFail($lead->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
        return view('leads.edit')
            ->withLead($lead);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        $lead->update($request->all());

        return redirect('/leads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect('/leads');
    }

    public function searchLeads(Request $request)
    {
        $search_result = CustomersRepo::customerInit()->searchCustomers($request->search_item, 'leads');

        $output = "";
        foreach ($search_result as $item){

            $output .= '<tr>'.
                '<td>'. ucwords($item->name).'</td>'.
                '<td>'.ucfirst($item->contact_person).'</td>'.
                '<td>'.$item->phone.'</td>'.
                '<td>'.$item->email.'</td>'.
                '<td>'.$item->address.'</td>'.
                '<td>'.$item->telephone.'</td>'.
                '<td>'.$item->location.'</td>'.
                '<td>'.Carbon::parse($item->created_at)->format('d-M-y').'</td>'.
                '<td>'.
'<form action="'.route('leads.destroy', $item->id).'" method="post">'.
                '<a href="'.route('leads.show', $item->id).'" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>'.
                                                '<a href="'.route('leads.edit', $item->id).'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>'.
                                                csrf_field().'<br>'.
                                                method_field('DELETE').
                                                '<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>'.
                                            '</form></td>'.
                '</tr>';
        }

        return Response(['output' => $output]);
    }
}
