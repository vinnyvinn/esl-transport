<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 1/31/18
 * Time: 12:48 PM
 */

namespace Esl\Repository;

use App\Customer;

class CustomersRepo
{
    public static function customerInit()
    {
        return new self();
    }

    public function searchCustomers($searchItem)
    {
        $result = Customer::where('Name','like','%'.$searchItem.'%')
            ->orWhere('Contact_Person','like','%'.$searchItem.'%')->get(['DCLink','Name','Account','Contact_Person','Telephone']);
        return $result;
    }
}