<?php

namespace App\Http\Controllers;

use App\VendorPayment;
use Illuminate\Http\Request;
use App\Http\Resources\VendorPayment as VendorPaymentResource;

class VendorPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'type' => 'nullable',
            'vendor_id' => 'required',
            'shipment_id' => 'required',
            'amount' => 'required|numeric',
            // 'commission' => 'required|numeric',
            ]);
        
            $payment = new VendorPayment;
     
            $payment->vendor_id = $request->vendor_id;
            $payment->shipment_id = $request->shipment_id;
            $payment->amount = $request->amount;
            $payment->type = $request->type;
            // $payment->commission = $request->commission;
           
            $payment->save();
            return new VendorPaymentResource($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function show(VendorPayment $vendorPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorPayment $vendorPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VendorPayment $vendorPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VendorPayment  $vendorPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorPayment $vendorPayment)
    {
        //
    }
}
