<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
       // return "PagesController@index";
        return view ('pages.index');
    }
    public function about()
    {
        // return "PagesController@index";
        return view ('pages.about');
    }
    public function services()
    {
        $data=array('title'=>'Services',
            'services'=> ['HR Solutions', 'Career Consultancy']);
        // return "PagesController@index";
        return view ('pages.services')->with($data);
    }

}

