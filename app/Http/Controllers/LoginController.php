<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
class LoginController extends Controller
{
    public function login(Request $request)
    {
     
     //   dd($request->input());
       // dd($request->all());
        $credentials = $request->only('email','password');
        $user = User::where('email', 'bilalahmad@gmail.com')->get()->first();
      //  dd($user);
        if (Auth::attempt($credentials)) {
            return response(['id' => $user->id, 'name' => $user->name, 'expires' => config('session.lifetime') * 60000]);
        }
        abort(400);
    }
}
