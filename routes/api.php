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
//Route::resource('/users','UsersController');

// Route::post('/roles/attach/','RolesController@attach_permission');
// Route::post('/roles/detach/','RolesController@detach_permission');

// Route::resource('/roles','RolesController');
// //Route::get('/roles/attach_role','RolesController@attach_role');

