<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=Customer::all();

       // return Customer::all();
        $customers=Customer::orderBy('created_at','desc')->paginate(3);
        return view('customers.index')->with('customers',$customers);
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
        $this->validate($request,[
            'name'=>'required'
        ]);
        //return  "abc";
        $customer=new Customer();
        $customer->name=$request->input('name');
        $customer->web_url=$request->input('web_url');
        $customer->img_url="Abc";
        $customer->save();
        return redirect('/customers')->with('success','Post Created');

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
        return view('customers.edit')->with('customer',$customer);
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
        $customer->delete();
        return redirect('/customers')->with('success','Post Deleted');
    }
}
