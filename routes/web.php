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
use App\Customer;
use App\Industry;
use App\Location;




Route::get('/', function () {






















































    

    $data = GoogleSheets::getDataFromSheets();
    $myCustomers = Customer::all();
   // echo count($myCustomers);
    //dd(($data));
    
    $newCustomer =[];
    $EQUALS =0;
    $existingIndustry = Industry::all();
    $existingLocation = Location::all();
    for ($i = 0;  $i < count($data); $i++){
        $updateCustomer = [];
        for($j = 0; $j < count($myCustomers); $j++){
          
            
            //echo 'i:'.$i.'j:'.$j;
            //echo 'data: '.$data[$i][0].'--- MyCustomer : '.$myCustomers[$j];
            
            //check if customer already exits
             if(strcasecmp($data[$i][0],$myCustomers[$j]->name) == $EQUALS){  
                 echo $data[$i][0].'---'.$myCustomers[$j]->name.':customer exists';
                 echo "<br>";
                 
                //if any chnages in location indusrty or web url
                
                
                //if customer web_url changes
                if(!$myCustomers[$j]->is_updated){
                    // if web_url is not change
                    echo $data[$i][2].'---'.$myCustomers[$j]->web_url.'customer url not updated from system';
                    echo "<br>";

                    
                    if(strcasecmp($data[$i][2],$myCustomers[$j]->web_url)){
                       //take screen shot
                    //    echo $data[$i][2].'---'.$myCustomers[$j]->web_url.'customer  updated from excel';
                    //    echo "<br>";


                       $updateCustomer['img_url'] = 'imag_url';
                       
                       $updateCustomer['web_url'] = $data[$i][2];

                    }
                  //  dd( $updateCustomer);
            
                      //

                }

               // if industry name changes
                if(strcasecmp($data[$i][7],$myCustomers[$j]->industry->name)){

                    echo $data[$i][7].'---'.$myCustomers[$j]->industry->name.'indusrty  updated from excel';
                    echo "<br>";

                    //check if changed industry name exit and get its id
                   
           
                    $industryId =null;
                   foreach($existingIndustry as $industry){
                       //if industry name same get the id
                       if(!strcasecmp($data[$i][7],$industry->name)){
                         //  $industryId = $existingIndustry->id;
                           $updateCustomer['industry_id']= $industry->id; 
                           echo $data[$i][7].'---'.$industry->name.'indusrty exist in inudstry table';
                            echo "<br>"; 
                           
                       }
                       // if given industry name not exists
                      
                   }
                   if(isset($updateCustomer['industry_id'])){
                    $newIndustry = new Industry();
                    $newIndustry->created_at = now();
                    $newIndustry->updated_at = now();
                    $newIndustry->name = $data[$i][7];
                   // $newIndustry->save();
                    //$updateCustomer['industry_id']= $newIndustry->id;  
                  // dd($newIndustry);

                   }


              
             }

             //check location changes
             if(strcasecmp($data[$i][9],$myCustomers[$j]->location->name)){

                echo $data[$i][9].'---'.$myCustomers[$j]->location->name.'location  updated from excel';
                echo "<br>";

                //check if changed industry name exit and get its id
                
       
               
               foreach($existingLocation as $location){
                   //if location name same get the id
                   echo '-----------------'.strcasecmp($data[$i][9],$location->name);
                   if(!strcasecmp($data[$i][9],$location->name)){
                     //  $locationId = $existingLocation->id;
                       $updateCustomer['location_id']= $location->id; 
                       echo $data[$i][9].'---'.$location->name.'location exist in location table';
                        echo "<br>"; 
                       
                   }
                   
                  
               }
               echo '<br>';
               echo '----------out of loop';
               // if given location name not exists
               if(!isset($updateCustomer['location_id'])){

                $newlocation = new Location();
                $newlocation->created_at = now();
                $newlocation->updated_at = now();
                $newlocation->name = $data[$i][9];
               // $newlocation->save();
                echo 'new location:'.$newlocation;
               // $updateCustomer['location_id']= $newlocation->id;  
              // dd($newIndustry);
            }

            
          
         }
        //update the customer
          
         if($updateCustomer){
             $uc =\Customer::where('name',$data[$i][0])->update($updateCustomer);

            dd($uc);
        }                
        }
        //insert new customer
        else {
            
            //check if given inudstry exits
         
                   

        }
       

        }
        if(!$updateCustomer){

            $industryId = null;
            $locationId = null;
            

            //generate image url
            $img_url = 'img_url';
            
            foreach($existingIndustry as $industry){
                if(!strcasecmp($data[$i][7],$industry->name)){
                    $industryId = $industry->id;
                }
            }
            //check if given location exists
            foreach($existingLocation as $location){
                if(!strcasecmp($data[$i][7],$location->name)){
                    $locationId = $location->id;
                }
            }


            
            if(!$industryId){
                $industryObj = new Industry();
                $industryObj->name =  $data[$i][7];
                $industryObj->save();
                $industryId = $industryObj->id;
            }

         

            if(!$locationId){
                $locationObj = new Location();
                $locationObj->name =  $data[$i][7];
                $locationObj->save();
                $locationId = $locationObj->id;

            }

          

            $newCustomerModel = new Customer();
            $newCustomerModel->name = $data[$i][0];
            $newCustomerModel->img_url = $img_url;
            $newCustomerModel->web_url = $data[$i][2];
            $newCustomerModel->industry_id =$industryId;
            $newCustomerModel->location_id =$locationId;
            $newCustomerModel->is_updated =0;

            ;
            echo 'new Customer created :'.$newCustomerModel->save();





        }
    }
    
    
    
    //dd($myCustomer);
    
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', 'HomeController@index');
    Route::resource('/customers','CustomersController');
    Route::resource('/users','UsersController');

});
