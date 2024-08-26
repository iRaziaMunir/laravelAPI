<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //3.Fetch all orders for a specific customer:
    public function getCustomerOrder($customerNumber){

        $orders = Order::where('customerNumber', $customerNumber)->get();

        return response()->json($orders);
    }

    //9.Fetch all orders that are pending shipment:
    public function getPendingShipmentOrders(){

        $pendingShipmentOrders = Order::where('status','On Hold')->get();

        return response()->json($pendingShipmentOrders);
    }

    //.12 Count the number of orders placed by each customer:

    public function countCustomerOrderNumbers($customerNumber){

        $customerOrderNumbers = Order::where('customerNumber', $customerNumber)->count('orderNumber');

        return response()->json(['order_count' => $customerOrderNumbers]);
    }

}
