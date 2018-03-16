<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class GenerateDocument extends Controller
{
    public function generateDocument($type, $id)
    {
        $dms = BillOfLanding::with(['vessel.vDocs','sof','quote.services',
            'quote.voyage','customer','cargo','consignee'])->findOrFail($id);
//        dd($dms);

        if ($type == 'cargo-manifest'){

//            return view('documents.cargo-manifest',compact('dms'));

            $pdf = PDF::loadView('documents.cargo-manifest',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('cargo-manifest.pdf');
        }

        elseif ($type == 'cfs-ro'){
            //            return view('documents.cargo-manifest',compact('dms'));

            $pdf = PDF::loadView('documents.cfs-ro',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('cfs-release-order.pdf');
        }

        elseif ($type == 'kpa'){
            //            return view('documents.cargo-manifest',compact('dms'));

            $pdf = PDF::loadView('documents.kpa',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('kpa.pdf');
        }
        elseif ($type == 'inward-manifest'){
//                        return view('documents.inward-manifest',compact('dms'));

            $pdf = PDF::loadView('documents.inward-manifest',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('inward-manifest.pdf');
        }
        elseif ($type == 'outward-manifest'){
//                        return view('documents.inward-manifest',compact('dms'));

            $pdf = PDF::loadView('documents.outward-manifest',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('outward-manifest.pdf');
        }

        elseif ($type == 'bl'){
//                        return view('documents.bl',compact('dms'));

            $pdf = PDF::loadView('documents.bl',compact('dms'));
            $pdf->setPaper('A4', 'portrait');
            return $pdf->download('bl.pdf');
        }

        else{
            dd('get here');
        }

    }
}
