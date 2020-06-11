<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = User::all();
        return response()->json($staff,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|max:255',
            'phone'=>'max:255',
            'role'=>'required|max:255',
        ]);
     
        $customer = User::create($request->all());
        return response()->json($customer,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = User::findOrFail($id);
        return response()->json($staff,200);
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
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
            'phone'=>'max:255',
            'role'=>'required|max:255',
        ]);
        $staff = User::findOrFail($id);
        $staff->email = $request->email;
        $staff->name = $request->name;
        $staff->phone = $request->phone;
        $staff->role = $request->role;
        $staff->user_notes = $request->user_notes;
        if($request->password != "")
        {
            $staff->password = $request->password;
        }

        $staff->save();

       
        return response()->json($staff,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();
        return response()->json(null,204);
    }
}
