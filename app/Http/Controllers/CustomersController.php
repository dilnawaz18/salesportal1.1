<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Industry;
use App\Location;
use Illuminate\Support\Facades\Storage;


use App\Screenshot;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::with(['location', 'industry'])->get();
        $formatted = [];    
        foreach($customers as $customer){
          
            array_push($formatted,[
                'id' => $customer->id,
                'name' => $customer->name,
                'img_url' => asset($customer->img_url),
                'web_url' => $customer->web_url,
                'location' => $customer->location->name,
                'industry_type' => $customer->industry->name,
                
            ]);
            
        }
        return $formatted;
       
       // return Customer::all();
        // $customers=Customer::orderBy('created_at','desc')->paginate(3);
        // return view('customers.index')->with('customers',$customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

   //  $files = $request->image;
      //  $data = $request->all();
      $file = $request->file('image');
      $ext = $file->extension();
      //$name = "customers".'.'.$ext ;
       $name = "customers".rand(10,100).'.'.$ext ;
      $path = Storage::disk('public')->putFileAs(
          'customers', $file, $name
      );
      $customer=new Customer;
  
      // $customer->name=$request->input('name');
  
  
      // $customer->web_url=$request->input('web_url');
       $customer->name="Hiiiiiiiiiiiii";
       $customer->web_url="qwerttttttttttttttt";
       $customer->img_url=$path;
       $customer->location_id = 1;
       $customer->industry_id = 1;
       $customer->save();
  
       return $path;
       
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/images');
        //     $image->move($destinationPath, $name);
        //     $this->save();
    
        //     return back()->with('success','Image Upload successfully');
        // }
        // return 'file not found';
        //return 'request';

         //  $files = $request->image;
      //  $data = $request->all();
    //   $file = $request->file('image');
    
    //   $ext = $file->extension();d
    //   //$name = "customers".'.'.$ext ;
    //   $destinationPath = public_path('/storage');
    //   $name = "customers".rand(10,100).'.'.$ext ;
      
    //   $file->move($destinationPath, 'newCustomer.jpeg');
    //   $this->save();

    
//      $path = Storage::disk('public')->put($name,$file);
      
       return 'asa';




        
        // $this->validate($request,[
        //     'name'=>'required'
        // ]);
        // //return  "abc";
        // $customer=new Customer();
        // $customer->name=$request->input('name');
        // $web_url=$request->input('web_url');
        // $customer->web_url=$web_url;
        // //
        // $customer->img_url="Abc";
        // $customer->save();
        // return redirect('/customers')->with('success','Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $customer= Customer::find($id);
        return view('customers.show')->with('customer',$customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $customer= Customer::find($id);
        $locations = Location::all('id','name');
        $industries =Industry::all('id','name');

        $formatted = [
        'id' => $customer->id,
        'name' => $customer->name,
        'img_url' => asset($customer->img_url),
        'web_url' =>$customer->web_url,
        'location_id' => $customer->location_id,
        'industry_id' => $customer->industry_id,
        'locations' =>$locations,
        'industries'=> $industries
   ];
    
        return json_encode( $formatted);
        // return view('customers.edit')->with('customer',$customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        
        $data = $request->all();
        return $data;
        return $request->input('location');
        $customer= Customer::find($id);
        //$location =Location::where('name',)
        $customer->name = $request->input('name');
        

        $file = $request->file('image');
        $ext = $file->extension();
       
        $img_url =$request->input('name').'.'.$ext;

        $customer->web_url=$request->input('web_url');
        $customer->location_id = 1;
        $customer->industry_id = 1;
       

        $path = Storage::disk('public')->putFileAs($file, $name);

        
         $customer->save();
       
        //
        $this->validate($request,[
            'name'=>'required'
        ]);
        //return  "abc";
        $customer=Customer::find($id);
        $customer->name=$request->input('name');
        $customer->web_url=$request->input('web_url');
        $customer->img_url="Abc";
        $customer->save();
        return redirect('/customers')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $customer=Customer::find($id);

       // if(auth()->user()->id ==$customer->user_id)
        //    return redirect('customers')->with('error','Unauthorized Page');
        $customer->delete();
        return redirect('/home')->with('success','Post Deleted');
    }

    public function searchOpt(){

        $locations = Location::all('id','name');
        $industries =Industry::all('id','name');
        $data = [
             'locations' =>$locations,
            'inudstires' => $industries
            ]


    }
}
