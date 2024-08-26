<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/products_with_productLine', [ProductController::class, 'getProductsWithProductLine']);
// Route::get('/customers_with_salesRep', [CustomerController::class, 'getCustomersWithSalesRep']);
// Route::get('/customers/{customerNumber}/orders', [OrderController::class, 'getCustomerOrder']);
// Route::get('/orders/{orderNumber}/order_detail', [OrderDetailController::class, 'getOrderDetail']);
// Route::get('/customers/{customerNumber}/total_amount', [PaymentController::class, 'getTotalAmount']);
// Route::get('/offices/{officeCode}/employees', [EmployeeController::class, 'getOfficeEmployees']);
// Route::get('/products/in_stock', [ProductController::class, 'getProductsInStock']);
// Route::get('/customers/highest_credit_limit', [CustomerController::class, 'getCustomerHighestCreditLimit']);
// Route::get('/orders/pending_shipment', [OrderController::class, 'getPendingShipmentOrders']);
// Route::get('/payments/date_range/{startDate}/{endDate}', [PaymentController::class, 'getPaymentsWithinDateRange']);
// Route::get('/products/product_line/{productLine}', [ProductController::class, 'getProductLineProduct']);
// Route::get('/orders/{customerNumber}/all_orders', [OrderController::class, 'countCustomerOrderNumbers']);
// Route::get('/offices/all_offices/{country}', [OfficeController::class, 'getCountryOffice']);
// Route::get('/orders/{productCode}/quantity_ordered', [OrderDetailController::class, 'getOrderedProductQuantity']);
// Route::get('/customers/total_orders', [CustomerController::class, 'getCustomersWithTotalOrderPlaced']);


Route::get('/offices/{officeCode}/employees', [EmployeeController::class, 'getOfficeEmployees']);
Route::get('/payments/date_range/{startDate}/{endDate}', [PaymentController::class, 'getPaymentsWithinDateRange']);
Route::get('/offices/all_offices/{country}', [OfficeController::class, 'getCountryOffice']);

Route::controller(ProductController::class)->group(function () {
    Route::get('/products_with_productLine', 'getProductsWithProductLine');
    Route::get('/products/in_stock', 'getProductsInStock');
    Route::get('/customers/{customerNumber}/total_amount', 'getTotalAmount');
    Route::get('/products/product_line/{productLine}', 'getProductLineProduct');

});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customers_with_salesRep',  'getCustomersWithSalesRep');
    Route::get('/customers/highest_credit_limit', 'getCustomerHighestCreditLimit');
    Route::get('/customers/total_orders', 'getCustomersWithTotalOrderPlaced');


});
Route::controller(OrderController::class)->group(function () {
    Route::get('/customers/{customerNumber}/orders', 'getCustomerOrder');
    Route::get('/orders/pending_shipment', 'getPendingShipmentOrders');
    Route::get('/orders/{customerNumber}/all_orders', 'countCustomerOrderNumbers');

   
});
Route::controller(OrderDetailController::class)->group(function () {
    Route::get('/orders/{orderNumber}/order_detail', 'getOrderDetail');
    Route::get('/orders/{productCode}/quantity_ordered', 'getOrderedProductQuantity');

});
