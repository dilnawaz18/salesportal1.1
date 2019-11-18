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
       // dd($request->all());
        $credentials = $request->only('email','password');
        $user = User::where('email', 'bilal@gmail.com')->get()->first();
        if (Auth::attempt($credentials)) {
            return response(['id' => $user->id, 'name' => $user->name, 'role' => $user->role->name, 'expires' => config('session.lifetime') * 60000]);
        }
        abort(400);
    }
}
