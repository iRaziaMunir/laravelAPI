<?php

use App\Http\Controllers\AuthController;
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

    Route::controller(AuthController::class)->group(function(){

        Route::post('/register', 'register');
        Route::post('/login', 'login');
    });

Route::group(['middleware' => ['auth:api']], function(){


    Route::controller(AuthController::class)->group(function(){
        
        Route::post('/logout', 'logout');
        Route::post('/profile', 'profile');
        Route::post('/refresh', 'refresh');
        
    });
    

    Route::get('/offices/{officeCode}/employees', [EmployeeController::class, 'getOfficeEmployees']);
    Route::get('/payments/date_range', [PaymentController::class, 'getPaymentsWithinDateRange']);
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


});
