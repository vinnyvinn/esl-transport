<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use App\GoodType;
use App\Quotation;
use App\ServiceTax;
use App\Tariff;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\CustomersRepo;
use Esl\Repository\NotificationRepo;
use Esl\Repository\QuotationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    public function showQuotation($id)
    {
        $quote = Quotation::with(['lead','parties','cargos.goodType','consignee',
            'vessel','voyage','services.tariff','remarks.user'])->findOrFail($id);

        return view('quotation.show')
            ->withQuotation($quote)
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withGoodtypes(GoodType::all())
            ->withTariffs(Tariff::all()->sortBy('name'));
    }

    public function requestQuotation($id)
    {
        Quotation::findOrFail($id)->update(['status' => Constants::LEAD_QUOTATION_REQUEST]);

        NotificationRepo::create()->notification(Constants::Q_APPROVAL_TITLE, Constants::Q_APPROVAL_TEXT,
            '/quotation/preview/'.$id,0,Constants::DEPARTMENT_AGENCY)
        ->success('Approval send successfully');

        return redirect()->back();
    }

    public function viewQuotation($id)
    {
        $quote = Quotation::with(['lead','cargos.goodType','vessel','services.tariff','remarks.user'])->findOrFail($id);

        return view('quotation.view')
            ->withQuotation($quote)
            ->withGoodtypes(GoodType::all())
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withTariffs(Tariff::all()->sortBy('name'));
    }

    public function previewQuotation($id)
    {
        $quote = Quotation::with(['lead','cargos.goodType','vessel','services.tariff','remarks.user'])->findOrFail($id);

        return view('quotation.preview')
            ->withQuotation($quote);
    }

    public function sendToCustomer($id)
    {
        QuotationRepo::make()->changeStatus($id,
            Constants::LEAD_QUOTATION_WAITING);

        NotificationRepo::create()->notification(Constants::Q_APPROVED_TITLE,
            Constants::Q_APPROVED_TEXT,
            '/quotation/preview/'.$id,0,'Agency', Auth::user()->id);

        //TODO:: generate pdf here

        NotificationRepo::create()->success('PDA send to client successfully');

        return redirect()->back();
    }

    public function pdfQuotation($id)
    {
        $quotation = Quotation::with(['lead','cargos.goodType','vessel','services.tariff'])->findOrFail($id);

        $pdf = PDF::loadView('quotation.pdf', compact('quotation'));
        return $pdf->download('pda.pdf');


    }

    public function customerAccept($id)
    {
        QuotationRepo::make()->changeStatus($id,
            Constants::LEAD_QUOTATION_ACCEPTED);

        NotificationRepo::create()->notification(Constants::Q_APPROVED_TITLE,
            Constants::Q_APPROVED_TEXT,
            '/quotation/preview/'.$id,0,'Agency', Auth::user()->id)->success('Accepted successfully');

        //TODO:: generate pdf here
        //TODO:: send mails

        return redirect()->back();
    }

    public function pdaStatus($status)
    {
        if ($status == Constants::LEAD_QUOTATION_PENDING){
            $dms = Quotation::with(['lead','vessel','cargos'])->where('status',
                Constants::LEAD_QUOTATION_PENDING)->simplePaginate(25);
        }

        if ($status == Constants::LEAD_QUOTATION_REQUEST){
            $dms = Quotation::with(['lead','vessel','cargos'])->where('status',
                Constants::LEAD_QUOTATION_REQUEST)->simplePaginate(25);
        }

        if ($status == Constants::LEAD_QUOTATION_APPROVED){
            $dms = Quotation::with(['lead','vessel','cargos'])->where('status',
                Constants::LEAD_QUOTATION_APPROVED)->simplePaginate(25);
        }

        return view('pdas.index')
            ->withDms($dms)
            ->withStatus($status);

    }

    public function customerDecline($id)
    {
        QuotationRepo::make()->changeStatus($id,
            Constants::LEAD_QUOTATION_DECLINED_CUSTOMER);

        NotificationRepo::create()->notification(Constants::Q_DECLINED_C_TITLE,
            Constants::Q_DECLINED_C_TEXT,
            '/quotation/preview/'.$id,0,'Agency', Auth::user()->id)
        ->warning('Declined by customer');

        //TODO:: generate pdf here
        //TODO:: send mails

        return redirect()->back();
    }

    public function convertCustomer(Request $request, $id)
    {
        $quotation = Quotation::with(['user','consignee','lead','parties','cargos.goodType',
            'vessel','voyage','services.tariff','remarks.user'])->findOrFail($id);

        if ($quotation->consignee == null){
            NotificationRepo::create()->error('No Consignee details added');
            return redirect()->back();
        }

        if ($quotation->voyage == null){
            NotificationRepo::create()->error('No Voyage details added');
            return redirect()->back();
        }

        if (count($quotation->services) < 1){
            NotificationRepo::create()->error('No Services added');
            return redirect()->back();
        }

        if (count($quotation->cargos) < 1){
            NotificationRepo::create()->error('No Cargo added');
            return redirect()->back();
        }

        QuotationRepo::make()->changeStatus($id,
            Constants::LEAD_QUOTATION_CONVERTED);

        NotificationRepo::create()->notification(Constants::Q_DECLINED_C_TITLE,
            Constants::Q_DECLINED_C_TEXT,
            '/quotation/preview/'.$id,0,'Agency', Auth::user()->id)
        ->success('Invoice generated and Project created successfully');

        $leadData =  $quotation->lead;
        $customer = CustomersRepo::customerInit()->convertLeadToCustomer($leadData->toArray());

        $bl = BillOfLanding::create([
            'vessel_id' =>$quotation->vessel_id,
            'quote_id' => $quotation->id,
            'voyage_id' => $quotation->id,
            'consignee_id' => $quotation->consignee->id,
            'Client_id' => $customer->DCLink,
            'laytime_start' => Carbon::now(),
            'time_allowed' => 0,
//            'cargo_id' => $quotation->cargos->first()->id,
            'cargo_id' => 1,
            'stage' => 'Pre-arrival docs',
            'status' => 0,
            'sof_status' => 0,
            'bl_number' => 'B/L-NO'.$customer->DCLink,
        ]);

        return redirect('/dms/edit/'.$bl->id);
    }
}
