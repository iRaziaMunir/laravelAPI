<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //5.Get the total amount paid by a customer:
    public function getTotalAmount($customerNumber){

        $totalAmount = Payment::where('customerNumber', $customerNumber )->sum('amount');

        return response()->json(['totalAmount' => $totalAmount]);
    }
    //10.List all payments made within a specific date range:

        public function getPaymentsWithinDateRange($startDate, $endDate){

            $paymentsWithinDateRange = Payment::whereBetween('paymentDate', [$startDate, $endDate])
            ->paginate(10);

            return response()->json($paymentsWithinDateRange);
        }
}
