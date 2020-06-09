<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\Customer as CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('role','customer')->paginate(100);
        return CustomerResource::collection($customers);
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
            'gst'=>'max:255',
            'address'=>'max:500',
            'phone'=>'max:255',
            'company_name'=>'max:255',
        ]);
     
        $customer = User::create($request->all());
        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $customer = User::findOrFail($id);
       return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
            'password'=>'max:255',
            'gst'=>'max:255',
            'address'=>'max:500',
            'phone'=>'max:255',
            'company_name'=>'max:255',
        ]);
        $customer = User::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        if($request->password !== "")
        {
            $customer->password = $request->password;
        }
        $customer->company_name = $request->company_name;
        $customer->gst = $request->gst;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->user_notes = $request->user_notes;
        $customer->save();
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();
        return response()->json(null,204);
    }
}
