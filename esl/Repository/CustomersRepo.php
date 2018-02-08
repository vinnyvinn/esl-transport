<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 1/31/18
 * Time: 12:48 PM
 */

namespace Esl\Repository;

use App\Customer;
use App\Lead;

class CustomersRepo
{
    public static function customerInit()
    {
        return new self();
    }

    public function searchCustomers($searchItem, $table)
    {
        if ($table == 'Client'){
            $result = Customer::where('Name','like','%'.$searchItem.'%')
                ->orWhere('Contact_Person','like','%'.$searchItem.'%')->get(['DCLink','Name','Account','Contact_Person','Telephone']);
            return $result;
        }
        elseif ($table == 'leads'){
            $result = Lead::where('name','like','%'.$searchItem.'%')
                ->orWhere('contact_person','like','%'.$searchItem.'%')
                ->orWhere('phone','like','%'.$searchItem.'%')
                ->orWhere('email','like','%'.$searchItem.'%')
                ->orWhere('address','like','%'.$searchItem.'%')
                ->orWhere('location','like','%'.$searchItem.'%')
                ->get();
            return $result;
        }
    }
}