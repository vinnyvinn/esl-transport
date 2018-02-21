<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use App\DmsComponent;
use App\Sof;
use App\Stage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Http\Request;

class DmsController extends Controller
{
    public function index()
    {
        $bl = BillOfLanding::with(['vessel','quote.services','customer','cargo'])->simplePaginate(25);

        return view('dms.index')
            ->withDms($bl);
    }

    public function edit($id)
    {
        $dms = BillOfLanding::with(['vessel.vDocs','sof','quote.services','quote.voyage','customer','cargo'])->findOrFail($id);

        $dmsComponents = DmsComponent::with(['scomponent.stage'])->where('bill_of_landing_id',$id)->get();
        $checklist = $dmsComponents->map(function ($value){
//            dd($value);
            return [
                'title' => $value->scomponent->stage->name,
                $value->scomponent->stage->name => [
                    'name' => $value->scomponent->name,
                    'type' => $value->scomponent->type,
                    'doc_links' => json_decode($value->doc_links),
                    'text' => $value->text,
                    'subchecklist' => $value->subchecklist,
                    'created_at' => $value->created_at
                ]
            ];
        })->reject(null);
//        dd($checklist->groupBy('title'));
        $update = false;
        if ($dms->code_name == null || $dms->seal_number == null || $dms->berth_number == null || $dms->place_of_receipt == null || $dms->date_of_loading == null ||
            $dms->number_of_crane == null ){
            $update = true;
        }

        return view('dms.edit')
            ->withDms($dms)
            ->withChecklist($checklist->groupBy('title'))
            ->withUpdate($update)
            ->withStages(Stage::with(['components'])->get());
    }

    public function store(Request $request)
    {
        $data = [];


        if ($request->has('checklist')){

            foreach ($request->checklist as $key => $check){
                $checklist = [];
                foreach ($check as $inner_key => $item){
                    array_push($checklist,$inner_key);
                }
                array_push($data,[$key => ['components'=>json_encode($checklist)]]);
            }

        }

        if ($request->has('text_value')){

            foreach ($request->text_value as $key => $item){
                array_push($data,[$key => ['text' => $item[0]]]);
            }
        }

        if ($request->has('doc_links')){
            foreach ($request->doc_links as $key => $doc_link){
                $doc_array = [];
                foreach ($doc_link as $doc){
                    $image = $doc;
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $filepath = 'documents/uploads/';

                    $image->move(public_path('documents/uploads/'),$name);
                    array_push($doc_array,$filepath.$name);
                }


                array_push($data,[$key => ['doc_links' => json_encode($doc_array)]]);

            }
        }

        $keys = [];

        $insertData = [];
        $now = Carbon::now();
        foreach ($data as $key => $datum){
            foreach ($datum as $data_key => $value){
                foreach ($value as $xkey => $inner){
                    if (!array_key_exists($data_key,$keys)){
                        array_push($insertData,[
                            'bill_of_landing_id' => $request->dms_id,
                            'stage_component_id' => $data_key,
                            'doc_links' => $xkey == "doc_links" ? $inner : null,
                            'text' => $xkey == "text" ? $inner : null,
                            'subchecklist' => $xkey == "components" ? $inner : null,
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);
                        $keys[$data_key] = $data_key;
                    }
                    else{
                        foreach ($insertData as $skey => $test){
                            array_push($insertData,[
                                'bill_of_landing_id' => $request->dms_id,
                                'stage_component_id' => $data_key,
                                'doc_links' => ($xkey == "doc_links" && $test['doc_links'] == null) ? $inner : $test['doc_links'],
                                'text' => ($xkey == "text"  && $test['text'] == null) ? $inner : $test['text'],
                                'subchecklist' => ($test['subchecklist'] == null && $xkey == "components") ? $inner : $test['subchecklist'],
                                'created_at' => $now,
                                'updated_at' => $now
                            ]);

                            unset($insertData[$skey]);
                            break;
                        }
                    }

                }
            }
        }

        DmsComponent::insert($insertData);
        return redirect()->back();
    }

    public function addSof(Request $request)
    {
        $data = $request->all();
        $data['from'] = Carbon::parse($request->from);
        $data['to'] = Carbon::parse($request->to);


        $sof = Sof::create($data);

        return Response(['success' => '<tr>'.
            '<td>'.$sof->created_at.'</td>'.
            '<td>'. Carbon::parse($sof->from)->format('H:i') .'HRS</td>'.
            '<td>'. Carbon::parse($sof->to)->format('H:i') .'HRS</td>'.
            '<td>'. $sof->crane_working.'</td>'.
            '<td>'. ucfirst($sof->remarks).'</td>'.
            '</tr>']);
    }

    public function updateDms(Request $request)
    {
        $data = $request->all();
        $data['laytime_start'] = Carbon::parse($request->laytime_start);
        $data['date_of_loading'] = Carbon::parse($request->date_of_loading);
        BillOfLanding::findOrFail($request->dms_id)->update($data);

        return redirect()->back();
    }

    public function generateLayTime($id)
    {
        $dms = BillOfLanding::with(['sof','cargo','vessel','customer','quote.voyage'])->findOrFail($id);

        $port_stay = ceil($dms->vessel->grt/$dms->discharge_rate);

        $laytime = [];
        $lowerpart['timeallowed'] = $this->getTimeDeatils(($port_stay * 24 * 60 * 60));
        ;

        foreach ($dms->sof->sortByDesc('created_at') as $sof){
            array_push($laytime,[
                'day' => Carbon::parse($sof->created_at)->format('l'),
                'date' => Carbon::parse($sof->created_at)->format('d-M-y'),
                'period' => Carbon::parse($sof->from)->format('H:i').' HRS - '.Carbon::parse($sof->to)->format('H:i').' HRS',
                'time_to_count' =>  ($sof->crane_working * 100) / $dms->number_of_crane,
                'days' =>  $this->getTimeDeatils(strtotime(Carbon::parse($sof->to))-strtotime(Carbon::parse($sof->from))),
                'remarks' => $sof->remarks,
                'secs' => abs(strtotime(Carbon::parse($sof->to))-strtotime(Carbon::parse($sof->from)))
            ]);
        }

        $lowerpart['laytimeused'] = $this->getTimeDeatils(collect($laytime)->sum('secs'));
        $lowerpart['timesave'] = $this->getTimeDeatils(($port_stay * 24 * 60 * 60) - collect($laytime)->sum('secs'));
        $data = [
            $lowerpart,
            $laytime,
            [
                'vesselname' => $dms->vessel->name,
                'bl' => $dms->bl_number,
                'supplier' => $dms->cargo->first()->shipper,
                'arrive' => Carbon::parse($dms->quote->voyage->vessel_arrived)->format('d-M-y'),
                'weight' => $dms->vessel->grt,
                'rate' => $dms->discharge_rate,
                'time' =>$dms->time_allowed,
                'ltime' =>$dms->laytime_start,
            ]

        ];


        $pdf = PDF::loadView('pdf.laytime',compact('data'));
        return $pdf->download('laytime.pdf');

        return view('pdf.laytime')
            ->withData($data);
    }

    public function getTimeDeatils($sec)
    {
        $dt1 = new DateTime("@0");
        $dt2 = new DateTime("@$sec");
        return $dt1->diff($dt2)->format('%a, %h, %i');
    }

}
