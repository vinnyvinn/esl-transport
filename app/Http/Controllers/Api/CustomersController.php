<?php

namespace App\Http\Controllers\Api;

use Esl\helpers\Constants;
use Esl\Repository\CustomersRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    public function searchCustomer(Request $request)
    {
        return response()->json(['customer_search' =>
            CustomersRepo::customerInit()->searchCustomers($request->customer_search)], Constants::STATUS_OK);
    }
}
