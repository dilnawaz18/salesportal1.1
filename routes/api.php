<?php

use Illuminate\Http\Request;

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
Route::post('/roles/attach/','RolesController@attach_permission');
Route::post('/roles/detach/','RolesController@detach_permission');

Route::resource('/roles','RolesController');
//Route::get('/roles/attach_role','RolesController@attach_role');

