<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Location;
use App\Industry;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers=Customer::all();


        return view('home')->with('customers',$customers);


       // return Customer::all();
       // $customers=Customer::orderBy('created_at','desc')->paginate(3);
        //return view('customers.index')->with('customers',$customers);
    }
}
