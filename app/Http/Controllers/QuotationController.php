<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use App\ExtraService;
use App\GoodType;
use App\Mail\QuotationApprovalRequest;
use App\Mail\QuotationRequestDissaproval;
use App\Mail\QuotationRequestApproval;
use App\Mail\EslClientQuotation;
use App\Mail\ClientResponse;
use App\Mail\HodApproval;
use App\Mail\HodClientQuotationDecline;
use App\Mail\HodProcessingApproval;
use App\Quotation;
use App\ServiceTax;
use App\Tariff;
use App\Project;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\CustomersRepo;
use Esl\Repository\NotificationRepo;
use Esl\Repository\QuotationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class QuotationController extends Controller
{
    public function showQuotation($id)
    {
        $quote = Quotation::with(['lead', 'parties', 'cargos.goodType',
            'vessel', 'voyage', 'services.tariff', 'remarks.user'])->findOrFail($id);

        if ($quote->service_type_id != null) {
            return view('quotation.other-service')
                ->withQuotation($quote)
                ->withTaxs(ServiceTax::all()->sortBy('Description'))
                ->withServices(ExtraService::all()->sortBy('name'));
        }

        return view('quotation.show')
            ->withQuotation($quote)
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withGoodtypes(GoodType::all())
            ->withTariffs(Tariff::all()->sortBy('name'));
    }

    public function requestQuotation($id)
    {
        // mail people
        Mail::to(Constants::HEAD_TRANSPORT_EMAIL)
            ->cc([Constants::ACCOUNTS_EMAIL, Constants::ACCOUNTS_EMAIL_TWO])
            ->send(new QuotationApprovalRequest(Auth::user(), URL::previous()));

        // update status
        Quotation::findOrFail($id)->update(['status' => Constants::LEAD_QUOTATION_REQUEST]);

        // status update success
        NotificationRepo::create()->notification(Constants::Q_APPROVAL_TITLE, Constants::Q_APPROVAL_TEXT,
            '/quotation/preview/' . $id, 0, Constants::DEPARTMENT_AGENCY)
            ->success('Approval request sent successfully');

        return redirect()->back();
    }

    public function viewQuotation($id)
    {
        $quote = Quotation::with(['lead', 'cargos.goodType', 'vessel', 'services.tariff', 'remarks.user'])->findOrFail($id);

        if ($quote->service_type_id != null) {
            return view('quotation.other-service-view')
                ->withQuotation($quote)
                ->withTaxs(ServiceTax::all()->sortBy('Description'))
                ->withServices(ExtraService::all()->sortBy('name'));
        }

        return view('quotation.view')
            ->withQuotation($quote)
            ->withGoodtypes(GoodType::all())
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withTariffs(Tariff::all()->sortBy('name'));
    }

    public function previewQuotation($id)
    {
        $quote = Quotation::with(['lead', 'cargos.goodType', 'vessel', 'services.tariff', 'remarks.user'])->findOrFail($id);

        if ($quote->service_type_id != null) {
            return view('quotation.other-preview')
                ->withQuotation($quote);
        }

        return view('quotation.preview')
            ->withQuotation($quote);
    }

    // manager approve quotation
    public function managerAprroveQuotation($id)
    {
        $quotation = Quotation::with('user')->findOrFail($id);

        $quotation->update(['status' => Constants::LEAD_QUOTATION_APPROVED]);

        Mail::to($quotation->user->email)
            ->cc([Constants::ACCOUNTS_EMAIL, Constants::ACCOUNTS_EMAIL_TWO])
            ->send(new QuotationRequestApproval(Auth::user(), URL::previous()));

        NotificationRepo::create()->notification(Constants::Q_APPROVAL_TITLE, Constants::Q_APPROVAL_TEXT,
            '/quotation/preview/' . $id, 0, Constants::DEPARTMENT_AGENCY)
            ->success('Quotation approval successfully');

        return redirect()->back();
    }

    // manager dissaprove quotation
    public function managerDisaprroveQuotation(Request $request, $id)
    {
        $quotation = Quotation::with('user')->findOrFail($id);

        $quotation->update(['status' => Constants::LEAD_QUOTATION_DECLINED]);

        Mail::to($quotation->user->email)
            ->cc([Constants::ACCOUNTS_EMAIL, Constants::ACCOUNTS_EMAIL_TWO])
            ->send(new QuotationRequestDissaproval(Auth::user(), URL::previous(), $request->disaproval_message));

        NotificationRepo::create()->notification(Constants::Q_APPROVAL_TITLE, Constants::Q_APPROVAL_TEXT,
            '/quotation/preview/' . $id, 0, Constants::DEPARTMENT_AGENCY)
            ->success('Quotation dissaproval successfully');

        return redirect()->back();
    }

    public function sendToCustomer(Request $request, $id)
    {
        $quotation = Quotation::with('lead')->findOrFail($id);

        $quotation->update(['status' => Constants::LEAD_QUOTATION_WAITING]);

        //TODO:: generate pdf here
        // NotificationRepo::create()->success('PDA send to client successfully');

        // $quotationPdf = PDF::loadView('pdf.quotation-email');
        // return $quotationPdf->stream('result.pdf');
        
        Mail::to($quotation->lead->email)
        ->send(new EslClientQuotation(Auth::user(),$quotation->lead,URL::previous(),$request->subject, $request->message,$quotation->identifier));
        // ->attachData($quotationPdf,$quotation->lead->name.'pdf',['mime' => 'application/pdf']);

        NotificationRepo::create()->notification(Constants::Q_APPROVAL_TITLE, Constants::Q_APPROVAL_TEXT,
            '/quotation/preview/' . $id, 0, Constants::DEPARTMENT_AGENCY)
            ->success('Client quotation sent successfully');

        return redirect()->back();
    }

    public function pdfQuotation($id)
    {
        $quotation = Quotation::with(['lead', 'cargos.goodType', 'vessel', 'services.tariff'])->findOrFail($id);

        $pdf = PDF::loadView('quotation.pdf', compact('quotation'));
        return $pdf->download('pda.pdf');

    }

    // clent accept quotation
    public function customerAccept($identifier)
    {
    
        $this->clientResponse($identifier,true,'Quotation Accepted','I accept the quotation linked below. You can proceed to the next steps.');

        return redirect()->route('client-quotation-response');
    }

    // client decline quotation
    public function customerDecline($identifier){

        $this->clientResponse($identifier,false,'Quotation Declined','I decline the quotation linked below. Please revise it and get back to me.');

        return redirect()->route('client-quotation-response');
    }


    // reused client response function
    private function clientResponse($identifier,$bool,$subject,$message){

        $quotation = Quotation::with('user','lead')->where('identifier', $identifier)->firstOrFail();

        Mail::to($quotation->user->email)
        ->send(new ClientResponse($quotation,$accepted=$bool,$subject,$message));

    }

    // user accept client accepted quotation
    public function userAcceptCustomerQuotation($id)
    {

        $quotation = Quotation::findOrFail($id);
        $quotation->update(['status' => Constants::LEAD_QUOTATION_ACCEPTED]);

        NotificationRepo::create()->notification(Constants::Q_APPROVED_TITLE,
            Constants::Q_APPROVED_TEXT,
            '/quotation/preview/' . $id, 0, 'Agency', Auth::user()->id)->success('Quotation status set to Accepted');

        Mail::to(Constants::HEAD_OF_DEPARTMENT)
        ->send(new HodApproval(Auth::user(), URL::previous()));

        return redirect()->back();
    }

    // user decline client declined quotation
    public function userDeclineCustomerQuotation($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->update(['status' => Constants::LEAD_QUOTATION_DECLINED_CUSTOMER]);

        NotificationRepo::create()->notification(Constants::Q_DECLINED_C_TITLE,
            Constants::Q_DECLINED_C_TEXT,
            '/quotation/preview/' . $id, 0, 'Agency', Auth::user()->id)
            ->warning('Quotation status set to Declined');

        Mail::to(Constants::HEAD_OF_DEPARTMENT)
        ->send(new HodClientQuotationDecline(Auth::user(), URL::previous()));

        return redirect()->back();
    }

       public function  allowForProcessing($id){

        $quotation = Quotation::with('user')->findOrFail($id);
        $quotation->update(['status' => Constants::LEAD_QUOTATION_ALLOWED]);

        NotificationRepo::create()->notification(Constants::Q_DECLINED_C_TITLE,
            Constants::Q_DECLINED_C_TEXT,
            '/quotation/preview/' . $id, 0, 'Agency', Auth::user()->id)
            ->warning('Quotation processing request sent successfully');

            Mail::to($quotation->user->email)
        ->send(new HodProcessingApproval(Auth::user(), $quotation->user ,URL::previous()));

        return redirect()->back();
    }

    public function pdaStatus($status)
    {
        if ($status == Constants::LEAD_QUOTATION_PENDING) {
            $dms = Quotation::with(['lead', 'vessel', 'cargos'])->where('status',
                Constants::LEAD_QUOTATION_PENDING)->simplePaginate(25);
        }

        if ($status == Constants::LEAD_QUOTATION_REQUEST) {
            $dms = Quotation::with(['lead', 'vessel', 'cargos'])->where('status',
                Constants::LEAD_QUOTATION_REQUEST)->simplePaginate(25);
        }

        if ($status == Constants::LEAD_QUOTATION_APPROVED) {
            $dms = Quotation::with(['lead', 'vessel', 'cargos'])->where('status',
                Constants::LEAD_QUOTATION_APPROVED)->simplePaginate(25);
        }

        return view('pdas.index')
            ->withDms($dms)
            ->withStatus($status);

    }

 

    public function convertCustomer(Request $request, $id)
    {
        $quotation = Quotation::with(['user', 'cargos', 'lead', 'parties', 'cargos.goodType',
            'vessel', 'voyage', 'services.tariff', 'remarks.user'])->findOrFail($id);

        if ($quotation->service_type_id == null) {

            // check if cargo has consignee name
            $null_cargos = collect();
            foreach($quotation->cargos as $cargo){
                if ($cargo->consignee_name == null) {
                    $null_cargos->push($cargo->id);
                }
            }

            if(count($null_cargos) > 0){
                NotificationRepo::create()->error( count($null_cargos).' cargos do not have consignee');
                return redirect()->back();
            }
            

            if ($quotation->voyage == null) {
                NotificationRepo::create()->error('No Voyage details added');
                return redirect()->back();
            }

            if (count($quotation->services) < 1) {
                NotificationRepo::create()->error('No Services added');
                return redirect()->back();
            }

            if (count($quotation->cargos) < 1) {
                NotificationRepo::create()->error('No Cargo added');
                return redirect()->back();
            }
        }

        $quotation->update(['status' => Constants::LEAD_QUOTATION_CONVERTED]);

        NotificationRepo::create()->notification(Constants::Q_DECLINED_C_TITLE,
            Constants::Q_DECLINED_C_TEXT,
            '/quotation/preview/' . $id, 0, 'Agency', Auth::user()->id)
            ->success('Invoice generated and Project created successfully');

        $leadData = $quotation->lead;
        $customer = CustomersRepo::customerInit()->convertLeadToCustomer($leadData->toArray());

        $bl = BillOfLanding::create([
            'vessel_id' => $quotation->vessel_id,
            'quote_id' => $quotation->id,
            'service_type_id' => $quotation->service_type_id != null ? $quotation->service_type_id : null,
            'voyage_id' => $quotation->service_type_id != null ? 0 : $quotation->id,
            // 'consignee_id' => $quotation->service_type_id != null ? 0 : $quotation->consignee->id,
            'Client_id' => $customer->DCLink,
            'laytime_start' => Carbon::now(),
            'time_allowed' => 0,
//          'cargo_id' => $quotation->cargos->first()->id,
            'cargo_id' => 0,
            'stage' => 'Pre-arrival docs',
            'status' => 0,
            'sof_status' => 0,
            'bl_number' => 'B/L-NO' . $customer->DCLink,
        ]);

        // $project = Project::create([

        // ]);

        return redirect('/dms/edit/' . $bl->id);
    }

    public function allPdas()
    {

        return view('quotation.pdas')
            ->withPdas(Quotation::get()->sortBy('created_at'));
    }

    public function allQuotations()
    {
        $quotations = Quotation::all();
        return view('quotation.index', ['quotations' => $quotations]);
    }
}
