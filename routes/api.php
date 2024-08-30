<?php 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('profile', 'profile');
});

Route::middleware('auth:api')->group(function () {
    
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