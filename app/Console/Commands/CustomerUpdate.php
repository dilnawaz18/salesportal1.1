<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Log;
use App\Services\GoogleSheets;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Industry;
use App\Location;
use App\User;
use App\Services\ScreenshotBS;


class CustomerUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'daily update customer list in database from excel sheet';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()

    {
        Log::info('message');
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
    
        
    }
}
