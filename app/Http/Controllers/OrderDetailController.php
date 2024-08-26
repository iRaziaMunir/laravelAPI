<?php

namespace App\Http\Controllers;

use App\Models\Orderdetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    //4.List all order details for a specific order
    public function getOrderDetail($orderNumber){

        $orderDetail = Orderdetail::where('orderNumber', $orderNumber)->get();

        return response()->json($orderDetail);
    }

    //14.Get the total quantity ordered for a specific product

    public function getOrderedProductQuantity($productCode){
        // Fetch a record that matches the productCode
        $orderDetail = Orderdetail::where('productCode', $productCode)->first();

        // Check if a record was found
        if ($orderDetail) {
            return response()->json(['quantity_ordered' => $orderDetail->quantityOrdered]);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

}
