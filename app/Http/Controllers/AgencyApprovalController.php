<?php

namespace App\Http\Controllers;

use App\Quotation;
use App\Remarks;
use Esl\helpers\Constants;
use Esl\Repository\AgencyRepo;
use Esl\Repository\NotificationRepo;
use Esl\Repository\QuotationRepo;
use Esl\Repository\RemarkRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgencyApprovalController extends Controller
{
    public function approve(Request $request)
    {
        $quotation = Quotation::findOrFail($request->quotation_id);
        QuotationRepo::make()->changeStatus($request->quotation_id,
            Constants::LEAD_QUOTATION_APPROVED);

        NotificationRepo::create()->notification(Constants::Q_APPROVED_TITLE,
            Constants::Q_APPROVED_TEXT,
            '/quotation/'.$request->quotation_id,0,'Agency', $quotation->user_id)
        ->success('Approved successfully');

        self::updates([
            'quotation_id' => $request->quotation_id,
            'user_id' => $quotation->user_id,
            'remarks' => $request->remarks
        ], 'Approved');

        return Response(['success' => 'Approved']);
    }

    public function revision(Request $request)
    {
        $quotation = Quotation::findOrFail($request->quotation_id);
        QuotationRepo::make()->changeStatus($request->quotation_id,
            Constants::LEAD_QUOTATION_DECLINED);

        NotificationRepo::create()->notification(Constants::Q_DISAPPROVED_TITLE,
            Constants::Q_DISAPPROVED_TEXT,
            '/quotation/'.$request->quotation_id,0,'Agency', $quotation->user_id)
        ->message('Quotation disapproved','Disapproval');

        self::updates([
            'quotation_id' => $request->quotation_id,
            'user_id' => $quotation->user_id,
            'remarks' => $request->remarks
        ], 'Disapproved');

        return Response(['success' => 'Revision']);
    }

    private function updates($data, $action){
        AgencyRepo::make()->quotationApproval([
            'user_id' => Auth::user()->id,
            'quotation_id' => $data['quotation_id'],
            'quotation_action' => $action,
            'remarks' => $data['remarks'] == null ? '' : $data['remarks']
        ]);

        if ($data['remarks']){
        RemarkRepo::make()->remark([
            'user_id' => Auth::user()->id,
            'remark_to' => $data['user_id'],
            'quotation_id' => $data['quotation_id'],
            'remark' => $data['remarks']
        ]);}
    }

    public function addRemark(Request $request)
    {
        RemarkRepo::make()->remark([
            'user_id' => Auth::user()->id,
            'remark_to' => Auth::user()->id,
            'quotation_id' => $request->quotation_id,
            'remark' => $request->remarks
        ]);

        // return Response(['success' => 'Approved']);
        NotificationRepo::create()->success('Remark added successfully');
        return redirect()->back();
    }

    public function deleteRemark(Request $request, $id){
        $remark = Remarks::findOrFail($id);
        $remark->delete();

        NotificationRepo::create()->success('Remark deleted successfully');
        return redirect()->back();
    }

    public function updateRemark(Request $request, $id){
        $remark = Remarks::findOrFail($id);
        $remark->user_id = Auth::user()->id;
        $remark->remark_to = Auth::user()->id;
        $remark->quotation_id = $request->quotation_id;
        $remark->remark = $request->remarks;
        $remark->update();

        NotificationRepo::create()->success('Remark updated successfully');
        return redirect()->back();
    }
}
