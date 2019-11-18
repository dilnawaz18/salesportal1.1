<?php

use App\Services\GoogleSheets;
// use Sheets;
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

use App\Services\ScreenshotBS;
use Illuminate\Http\Request;

use App\Customer;
use App\Industry;
use App\Location;

use Illuminate\Support\Facades\Auth;
use App\User;


// Route::get('/url', function () {
//     $id=1;
//     $pathToImage='/var/www/html/salesportal/public/storage/customer'.$id.'.jpeg';;
//     Browsershot::url('https://google.com')->setScreenshotType('jpeg',100)->windowSize(1920, 1080)
//     ->fit(Manipulations::FIT_CONTAIN, 1000, 1000)->save($pathToImage);
//     return ('welcome');

// });

Route::get('/screenshotbs/{customer_id}', function (Request $request, $customer_id) {
    $img_url=$request->get('img_url');
    $res=  ScreenshotBS::get_Screenshot($customer_id, $img_url);
    return view('welcome')->with('path',$res['url']);


 });

Route::get('/check', function () {
    $str = 'Not launched yet';
   return preg_match('/\bLaunched\b/i',$str);
    //return view ('welcome');

});

// Route::get('/screenshot/{customer_id}/{img_url}', function ($customer_id, $img_url) {
//    $path=  Screenshot::get_Screenshot($customer_id,$img_url);
// echo $path;
//
//    return view ('welcome')->with('path',$path);

// });




// function getIndustryId($industries,$industry){

//     if( isset($industries[$industry])) return $i/ndustries[$industry];
//     return;
// }
// function getLocationId($locations,$location){

//     if( isset($locations[$location])) return $locations[$location];
//     return;
// }
// function isWebUrlUpdated($customerFromDB,$web_url_from_sheet){

//    // $customerFromDB =$customers[$customer[$header['Client Name']]];
//    // $webUrlFromDB =  $customerFromDB['web_url'];
//     //$webUrlFromSheet =  $customer[$header['BCC URL']];

//     if($customerFromDB['is_updated']) return;
//      if(strcasecmp($customerFromDB['web_url'],$web_url_from_sheet)){



//     }

// }
// function updateCustomer($customerFromDB,$customerFromSheet){


//     if(isset($customers[$customer[$header['Client Name']]])){
//         // echo 'customer exits';
//         // echo '<br>';

//         //validate if web url change
//         //if(($customers[$customer[$header['Client Name']]]))

//     }else{
//         echo 'customer not exits';
//         echo '<br>';


//     }


// }


Route::get('/', function () {

    //fomate the data
    $customersFromSheet = GoogleSheets::getDataFromSheets();
    $header = array_flip ($customersFromSheet[0]);
    array_shift($customersFromSheet);
    //dd($customersFromSheet);
    $industries = Industry::pluck('id','name')->toArray();
    $locations = Location::pluck('id','name')->toArray();
   // dd($industries);
   // dd($locations);
    $customersFromDB = Customer::all()->keyBy('name');

  foreach ($customersFromSheet as $customerFromSheet ){


    if(!(empty($customerFromSheet[$header['Client Name']]) || empty($customerFromSheet[$header['BCC URL']]) ||
    empty($customerFromSheet[$header['Industry']]) || empty($customerFromSheet[$header['Location']]) || preg_match('/\bLaunched\b/i',$customerFromSheet[$header['BCC URL']])) ){
        //updateCustomer($customersFromDB,$customer,$header);

       //check if customer from sheet exists in db
    if(isset($customersFromDB[$customerFromSheet[$header['Client Name']]])){
        $customerFromDB =$customersFromDB[$customerFromSheet[$header['Client Name']]];
        echo 'customer already exits';
        echo '<br>';

        if(!$customerFromDB->is_updated){
            echo 'is_updated';
            echo '<br>';

            //check if any feild update
            echo $customerFromDB->web_url.'-----'.$customerFromSheet[$header['BCC URL']].'---'.$customerFromSheet[$header['Client Name']];
            echo '<br>';

            if(
            strcasecmp($customerFromDB->web_url,$customerFromSheet[$header['BCC URL']]) ||
            strcasecmp($customerFromDB->industry->name,$customerFromSheet[$header['Industry']])||
            strcasecmp($customerFromDB->location->name,$customerFromSheet[$header['Location']]))
                {
                    echo ' any feild change';
                    echo '<br>';

                    //check if web url update

                    if(strcasecmp($customerFromDB->web_url,$customerFromSheet[$header['BCC URL']])){
                        //screen shot
                        echo $customerFromDB->id.' web_url change';
                        echo '<br>';
                        $customerFromDB->img_url = 'www.google.com';
                        $customerFromDB->web_url = $customerFromSheet[$header['BCC URL']];

                    }
                    //check if industry update
                    echo $customerFromDB->industry->name.'-----'.$customerFromSheet[$header['Industry']].'---'.$customerFromSheet[$header['Client Name']];
                    echo '<br>';

                    if(strcasecmp($customerFromDB->industry->name, $customerFromSheet[$header['Industry']])){

                        echo ' industry change';
                        echo '<br>';

                        if(isset($industries[$customerFromSheet[$header['Industry']]])){
                            $customerFromDB->industry_id = $industries[$customerFromSheet[$header['Industry']]];

                        }
                        else {
                            $industry = new Industry();
                            $industry->name =  $customerFromSheet[$header['Industry']];
                            $industry->save();
                            $industries[$industry->name] = $industry->id;
                            $customerFromDB->industry_id = $industry->id;

                        }

                    }

                    //check if location update
                    if(!$customerFromDB->location == $locations[$customerFromSheet[$header['Location']]]){

                        if(isset($locations[$customerFromSheet[$header['Location']]])){
                            $customerFromDB->location_id = $locations[$customerFromSheet[$header['location']]];

                        }
                        else {
                            $location = new Location();
                            $location->name =  $customerFromSheet[$header['Location']];
                            $location->save();
                        //    $locations->push($location);
                            $customerFromDB->id = $location->id;

                        }


                    }

                    $customerFromDB->save();

                }



        }
        //isWebUrlUpdated($customerFromDB,$customerFromSheet[$header['BCC URL']]);



        // echo 'customer exits';
        // echo '<br>';

        //validate if web url change
        //if(($customers[$customer[$header['Client Name']]]))

    }else{
        $customer = new Customer();
        try{
            $customer->name = $customerFromSheet[$header['Client Name']];
            echo 'saving image of : '.$customerFromSheet[$header['Client Name']];
            $res=  ScreenshotBS::get_Screenshot($customerFromSheet[$header['Client Name']], $customerFromSheet[$header['BCC URL']]);
            $customer->img_url =  $res['url'];
            $customer->web_url =  $customerFromSheet[$header['BCC URL']];

        }catch(Exception $e){
            echo 'exception of url load : '.$e->getMessage();
            $customer->name = $customerFromSheet[$header['Client Name']];
            echo 'saving image of : '.$customerFromSheet[$header['Client Name']];
            $customer->img_url = 'storage/default.jpeg';
            $customer->web_url =  $customerFromSheet[$header['BCC URL']];

        }

         //generate img_url
       //  print_r($header['Client Name']);
       //  dump($customerFromSheet);




        //check if industry already exist
        if(isset($industries[$customerFromSheet[$header['Industry']]])){
            echo $industries[$customerFromSheet[$header['Industry']]].'--industry exists';
            echo '<br>';
            $customer->industry_id = $industries[$customerFromSheet[$header['Industry']]];

        }
        else {
            $industry = new Industry();
         //   print_r ($customerFromSheet[$header['Industry']]);
          //  dd();
            $industry->name =  $customerFromSheet[$header['Industry']];

            $industry->save();
            $industries[$industry->name] = $industry->id;
            $customer->industry_id = $industry->id;
           // dump($industries);

        }

        //check if location already exist
        if(isset($locations[$customerFromSheet[$header['Location']]])){
            echo $customerFromSheet[$header['Location']].'--location exists';
            echo '<br>';
            $customer->location_id = $locations[$customerFromSheet[$header['Location']]];

        }
        else {
            echo $customerFromSheet[$header['Location']].'--location exists';
            echo '<br>';

            $location = new Location();
            $location->name =  $customerFromSheet[$header['Location']];
            $location->save();
            $locations[$location->name] = $location->id;

            // $locations->push($location);
            $customer->location_id = $location->id;

        }
        $customer->is_updated = 0;
        $customer->save();
        $customersFromDB->push($customer);
    }
    }
  }
 dd($industries);



});


Route::get('test', function () {
   // return 'test';
    $locations = Location::all();
    dump($locations);
    $location = new Location();
    $location->name = 'test';
    $location->save();
    $locations->push($location);
    dd($locations);
});
Route::get('login',function(){

    $user=User::where('email','dil-nawaz@bayt.net')->get()->first();
    Auth::login($user);

});


// Route::get('registration',function(){

//     dd(Auth::user());
// });
Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', 'HomeController@index');
    Route::resource('/customers','CustomersController');
    Route::resource('/users','UsersController');

});
