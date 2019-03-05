<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Esl\Repository\NotificationRepo;
use Esl\Repository\UploadFileRepo;
use App\ServiceCost;
use App\ServiceCostDoc;

class ServiceCostController extends Controller
{
    public function saveServiceCost(Request $request){

        $serviceCost = new ServiceCost($request->except(['name','supporting_docs']));
        $serviceCost->save();
        if(!empty($request->supporting_docs)){
            $path_file = UploadFileRepo::init()->upload($request->supporting_docs, 'documents/uploads/');

            $serviceCostDoc = new ServiceCostDoc([
                'service_cost_id' => $serviceCost->id,
                'doc_path' => $path_file,
                'name' => $request->name,
            ]);

        }

        NotificationRepo::create()->success('Service Cost added successfully');
        return redirect()->back();
    }
}
