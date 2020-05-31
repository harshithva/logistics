<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin', function () {
    return view('admin.master');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::view('/admin/{any}', 'admin.master');

Route::get('/admin/{any}', function () {
    return view('admin.master');
})->where('any','.*');