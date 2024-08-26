<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function getCustomersWithSalesRep(){

        $customers = Customer::join('employees', 'customers.salesRepEmployeeNumber', '=', 'employees.employeeNumber')
        ->select('customers.*', 'employees.firstName as salesRepFirstName', 'employees.lastName as salesRepLastName')
        // ->get();
        ->paginate(10);

        return response()->json($customers);
    }

    //8.Get the highest credit limit among all customers:

    public function getCustomerHighestCreditLimit(){

        $highestCreditLimit = Customer::max('creditLimit');

        return response()->json(['highestCreditLimit' => $highestCreditLimit]);
    }

    //.15 Get a list of customers along with the total number of orders they have placed:

    public function getCustomersWithTotalOrderPlaced(){

        $customersWithTotalOrderPlaced = Customer::select('customers.customerNumber','customers.customerName', DB::raw('count(orders.orderNumber) as total_orders'))
        ->leftJoin('orders', 'customers.customerNumber', '=', 'orders.customerNumber')
        ->groupBy('customers.customerNumber', 'customers.customerName')
        ->get();

        return response()->json($customersWithTotalOrderPlaced);
    }
}
