<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("shipments", 'ShipmentController');
Route::apiResource("shipments/{id}/payments", 'PaymentController');
Route::apiResource("shipments/{id}/status", 'ShipmentStatusController');
Route::apiResource("quotations", 'QuoteController');
Route::post("quotations/{quotation}/status/approve", 'QuoteController@approve_status');
Route::post("quotations/{quotation}/status/decline", 'QuoteController@decline_status');
Route::post("quotations/{id}/quote_send_email", 'QuoteController@quote_send_email');

Route::get("shipments/{id}/balance_amount", 'ShipmentController@balance_amount');
Route::get("shipments/{id}/shipment_status", 'ShipmentController@shipment_status');
Route::post("shipments/{id}/shipment_send_email", 'ShipmentController@shipment_send_email');

Route::post("shipments/{id}/shipment_send_sms", 'ShipmentController@shipment_send_sms');

Route::apiResource("payments", 'PaymentController');
Route::apiResource("packages", 'PackageController');

Route::apiResource("customers", 'CustomerController');
Route::get("customers/{id}/invoices", 'CustomerController@get_customer_invoices');
Route::get("customers/{id}/quotes", 'CustomerController@get_customer_quotes');
Route::get("dashboard", 'CustomerController@dashboard');


Route::apiResource("staffs", 'StaffController');