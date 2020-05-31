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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/**
 * Customers end poins
 */
//Get all customers
Route::get('/customers', 'CustomersController@index');
//Get customer
Route::get('customers/{customer}', 'CustomersController@show');
//create customer
Route::post('customers', 'CustomersController@store');
//Update customer
Route::put('customers/{customer}', 'CustomersController@update');
//Delete customer
Route::delete('customers/{customer}', 'CustomersController@delete');

//Get all staff
Route::get('/staff', 'StaffController@index');
//Get customer
Route::get('staff/{staff}', 'StaffController@show');
//create customer
Route::post('staff', 'StaffController@store');
//Update customer
Route::put('staff/{staff}', 'StaffController@update');
//Delete customer
Route::delete('staff/{staff}', 'StaffController@delete');
