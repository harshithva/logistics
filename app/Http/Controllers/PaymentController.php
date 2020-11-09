<?php

namespace App\Http\Controllers;

use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Payment as PaymentResource;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return PaymentResource::collection($payments);
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
        'payment_type' => 'max:255',
        'received_from' => 'max:255',
        'customer_id' => 'required',
        'shipment_id' => 'required',
        'amount' => 'required|max:255',
        'payment_date' =>'required|max:255',
        'bank_name' => 'max:255',
        'upi_ref_id'=> 'max:255',
        'cheque_no'=> 'max:255',
        ]);
    
        $payment = new Payment;
 
        $payment->payment_type = $request->payment_type;
        $payment->customer_id = $request->customer_id;
        $payment->shipment_id = $request->shipment_id;
        $payment->amount = $request->amount;
        $payment->payment_date= Carbon::createFromFormat('d/m/Y', $request->payment_date )->format('Y-m-d');
        $payment->cheque_no = $request->cheque_no;
        $payment->upi_ref_id = $request->upi_ref_id;
        $payment->bank_name = $request->bank_name;
        $payment->save();
        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        
        $payment->update($request->all());

        return response()->json($payment,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(null,204);
    }
}
