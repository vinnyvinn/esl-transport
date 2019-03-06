<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Esl\Repository\NotificationRepo;
use Esl\Repository\UploadFileRepo;
use App\Funds;
use App\FundDoc;
use Illuminate\Support\Facades\Auth;

class FundsController extends Controller
{
    public function saveFund(Request $request){

        $data = $request->except(['name','supporting_docs']);
        $data['employee_id'] = Auth::user()->id;

        $fund = new Funds($data);
        $fund->save();
        if(!empty($request->supporting_docs)){
            $path_file = UploadFileRepo::init()->upload($request->supporting_docs, 'documents/uploads/');

            $fundDoc = new FundDoc([
                'fund_id' => $fund->id,
                'doc_path' => $path_file,
                'name' => $request->name,
            ]);

            $fund->fundDoc()->save($fundDoc);
        }

        NotificationRepo::create()->success('Quotation Request Fund added successfully');
        return redirect()->back();
    }
}
