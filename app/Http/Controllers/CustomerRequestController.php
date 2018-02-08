<?php

namespace App\Http\Controllers;

use App\GoodType;
use App\Lead;
use Esl\helpers\Constants;
use Illuminate\Http\Request;

class CustomerRequestController extends Controller
{
    public function customerRequest($customer_id, $customer_type)
    {
        if ($customer_type == Constants::LEAD_CUSTOMER)
        {
            $lead = Lead::findOrfail($customer_id);

            return view('customers.request')
                ->withCustomer($lead);
        }
    }
}
