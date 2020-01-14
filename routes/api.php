<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a grgit oup which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 use App\Http\Controllers\api\CustomerController;
Route::middleware('auth:api')->get('/user', function (Request $request) {
   
});

Route::resource('/customers','CustomersController');
Route::post('updatefile/{id}','CustomersController@updateFile');
Route::post('/login', 'LoginController@login');
