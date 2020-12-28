<?php

namespace App\Http\Controllers;

use App\VendorExpense;
use Illuminate\Http\Request;
use App\Http\Resources\VendorExpense as VendorExpenseResource;
use Carbon\Carbon;
use Helpers;


class VendorExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = VendorExpense::latest()->get();
        return VendorExpenseResource::collection($expenses);
    }


    public function this_month()
    {
        $expenses = Helpers::getThisMonth(VendorExpense::class);
        return VendorExpenseResource::collection($expenses);
    }

    public function last_month()
    {
        $expenses = Helpers::getLastMonth(VendorExpense::class);
        return VendorExpenseResource::collection($expenses);
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
        $this->validate($request,[
            'name'=>'required|min:1|max:255',
            'vendor_id'=>'required|integer',
            'note'=>'nullable|max:1000',
            'amount'=>'required|numeric',
        ]);
        
       $expense = new VendorExpense;
       $expense->name = $request->name;
       $expense->note = $request->note;
       $expense->vendor_id = $request->vendor_id;
       $expense->amount = $request->amount;
       $expense->save();

       return new VendorExpenseResource($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VendorExpense  $vendorExpense
     * @return \Illuminate\Http\Response
     */
    public function show(VendorExpense $vendorExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VendorExpense  $vendorExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorExpense $vendorExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VendorExpense  $vendorExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorExpense $vendorExpense)
    {
        $this->validate($request,[
            'name'=>'required|min:1|max:255',
            'vendor_id'=>'required|integer',
            'note'=>'nullable|max:1000',
            'amount'=>'required|numeric',
        ]);
        
       $vendorExpense->name = $request->name;
       $vendorExpense->note = $request->note;
       $vendorExpense->vendor_id = $request->vendor_id;
       $vendorExpense->amount = $request->amount;
       $vendorExpense->save();

       return new VendorExpenseResource($vendorExpense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VendorExpense  $vendorExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorExpense $vendorExpense)
    {
        $vendorExpense->delete();
        return response()->json(null, 204); 
    }
}
