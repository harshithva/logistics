<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Hash;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    
    return $request->user();
});


Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
            'message' => ['These credentials do not match our records.']
        ], 404);
    }


    $token = $user->createToken('my-app-token')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);
});

Route::apiResource("shipments", 'ShipmentController');
Route::apiResource("price_lists", 'ShipmentRateController');
Route::post("price_lists/{id}/delete", 'ShipmentRateController@delete');

Route::apiResource("shipments/{id}/payments", 'PaymentController');
Route::apiResource("shipments/{id}/status", 'ShipmentStatusController');

Route::apiResource("quotations", 'QuoteController');
Route::post("quotations/{quotation}/status/approve", 'QuoteController@approve_status');
Route::post("quotations/{quotation}/status/decline", 'QuoteController@decline_status');
Route::post("quotations/{id}/quote_send_email", 'QuoteController@quote_send_email');

Route::get("shipments/{id}/balance_amount", 'ShipmentController@balance_amount');
Route::get("shipments/{id}/shipment_status", 'ShipmentController@shipment_status');
Route::post("shipments/{id}/shipment_send_email", 'ShipmentController@shipment_send_email');
Route::post("shipments/{id}/shipment_send_docket", 'ShipmentController@shipment_send_docket');

Route::post("shipments/{id}/shipment_send_sms", 'ShipmentController@shipment_send_sms');
Route::get("shipments/{tracking_no}/shipment_track", 'ShipmentController@shipment_track');

Route::apiResource("payments", 'PaymentController');
Route::apiResource("packages", 'PackageController');

// feedback
Route::post('/customer/feedback', 'ShipmentController@send_feedback');

Route::apiResource("customers", 'CustomerController');
Route::get("customers/{id}/invoices", 'CustomerController@get_customer_invoices');
Route::get("customers/{id}/quotes", 'CustomerController@get_customer_quotes');
Route::get("dashboard", 'CustomerController@dashboard');


Route::apiResource("staffs", 'StaffController');

// expense_categories
Route::apiResource("expense_categories", 'ExpenseCategoryController');
// expenses
Route::apiResource("expenses", 'ExpenseController');
Route::get("/expenses/this_month/get", 'ExpenseController@this_month');
Route::get("/expenses/last_month/get", 'ExpenseController@last_month');