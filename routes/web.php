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
Route::get('/staff', 'HomeController@staff')->name('staff');
Route::get('/customer', 'HomeController@customer')->name('customer');

// Route::view('/admin/{any}', 'admin.master');

Route::get('/admin/{any}', function () {
    return view('admin.master');
})->where('any','.*');



Route::get('/customer/{any}', function () {
    return view('customer.master');
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