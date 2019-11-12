<?php

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
use App\Services\Screenshot;
use App\Services\ScreenshotBS;
use Illuminate\Http\Request;



// Route::get('/url', function () {
//     $id=1;
//     $pathToImage='/var/www/html/salesportal/public/storage/customer'.$id.'.jpeg';;
//     Browsershot::url('https://google.com')->setScreenshotType('jpeg',100)->windowSize(1920, 1080)
//     ->fit(Manipulations::FIT_CONTAIN, 1000, 1000)->save($pathToImage);
//     return ('welcome');

// });

Route::get('/screenshotbs/{customer_id}', function (Request $request, $customer_id) {
    $img_url=$request->get('img_url');
   //return $img_url;

    $res=  ScreenshotBS::get_Screenshot($customer_id, $img_url);
//  echo "path is".$path;
    return view('welcome')->with('path',$res['url']);

 });

Route::get('/', function () {
    return view ('welcome');

});

// Route::get('/screenshot/{customer_id}/{img_url}', function ($customer_id, $img_url) {
//    $path=  Screenshot::get_Screenshot($customer_id,$img_url);
// echo $path;
//
//    return view ('welcome')->with('path',$path);

// });





Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('/customers','CustomersController');
    //Route::resource('/users','UsersController');

});
