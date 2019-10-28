<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Role;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'role';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       // return $request->input('name');
        $role = new Role();
        $role->name = $request->input('name');
        //return $role;
        $role->save();
        return 'success';

       // return $request->getContent();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function attach_permission(Request $request){
       //$role = Role::find($request->input('role_id'));
        $content = $request->getContent();
        $x = json_decode($content,true);
        $role = Role::find($x['role_id']);
       $role->permissions()->attach($x['permission_id']);
        //return  $role->permissions->first()->name;
        return $role;


    }
    public function detach_permission(Request $request){
        $content = $request->getContent();
        $x = json_decode($content,true);
        $role = Role::find($x['role_id']);
        $role->permissions()->detach($x['permission_id']);
        return 'succesfully detach';
    }
}
