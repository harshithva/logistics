<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ShipmentCreated;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/admin', function () {
//     return view('admin.master')
// });
Route::get('/template', function () {
    return new ShipmentCreated();
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');
Route::get('/track', 'HomeController@track')->name('track');
Route::get('/staff', 'HomeController@staff')->name('staff');
Route::get('/customer', 'HomeController@customer')->name('customer');
Route::get('/customer/quote/Td66URYw3EUnKUEz4xQYDKFDDBJAWhSEafjL8kLYnvJMuWVV8bgYrN2pAEGR/{quote_id}/SvJAax3Avtf3u8JmnQGjBKTYSY7gfkRybzLRng53Lh3hqPtLtMt76L8udNPB/view', 'QuoteController@view_quote');
Route::get('/customer/invoice/XSFQqLeeNrRTQjK95ea7mnkGbU74eLUEets272Lq2nnSXkEfLkYtAxtgfz2B/{shipment_id}/y8NRkCN4X9pHh6RM327hZTRd9ErSgmWd4P6zB52mZJLT9rqry7pVU6tzf6L8/view', 'ShipmentController@view_invoice');
Route::get('/customer/docket/8jZSqbGNmzk25EcBgMsWYyDP4LDEAS7amrVevmqcTE67ByuajGaks8UqmLmJ/{shipment_id}/urMrnM6JNuGPCnEdnmDqzfWfDYAUSYb8rkveHF9mWGPgD2XxH4SYRXjRCnmx/view', 'ShipmentController@view_docket');
Route::get('/customer/feedback/{shipment_id}', 'ShipmentController@feedback');


Route::get('invoices/mobile/{shipment_id}', 'ShipmentController@invoicePDF')->name('invoicePDF');
Route::get('quotes/mobile/{quote_id}', 'QuoteController@view_quote_mobile')->name('view_quote_mobile');

// Route::view('/admin/{any}', 'admin.master');

Route::get('/admin/{any}', function () {
    return view('admin.master');
})->where('any','.*');



Route::get('/customer/{any}', function () {
    return view('customer.master');
})->where('any','.*');

Route::get('/vendor_dashboard', function () {
    return view('customer.master');
})->where('any','.*');

Route::get('/vendor_dashboard/{any}', function () {
    return view('customer.master');
})->where('any','.*');

Route::get('/terms', function () {
    return view('terms');
})->where('any','.*');




Route::get('/test', function()
{
    $beautymail = app()->make(Snowfire\Beautymail\Beautymail::class);
    $data = 'Hi';
    $beautymail->send('emails.welcome', compact('data'), function($message)
    {
        $message
			->from('crm@gurukal.co.in')
			->to('harshith11032001@gmail.com', 'John Smith')
			->subject('Welcome!');
    });

});