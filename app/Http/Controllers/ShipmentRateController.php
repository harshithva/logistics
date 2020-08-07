<?php

namespace App\Http\Controllers;

use App\ShipmentRate;
use Illuminate\Http\Request;

class ShipmentRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price_lists = ShipmentRate::all();
        return $price_lists;
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
        $shipmentRate = new ShipmentRate;
        $shipmentRate->from = 'bangalore';
        $shipmentRate->to = $request->to;
        $shipmentRate->rate_1 = $request->rate_1;
        $shipmentRate->rate_2 = $request->rate_2;
        $shipmentRate->save();

        return $shipmentRate;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShipmentRate  $shipmentRate
     * @return \Illuminate\Http\Response
     */
    public function show(ShipmentRate $shipmentRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShipmentRate  $shipmentRate
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipmentRate $shipmentRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShipmentRate  $shipmentRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipmentRate $shipmentRate)
    {
        $shipmentRate->from = 'Bangalore';
        $shipmentRate->to = $request->to;
        $shipmentRate->rate_1 = $request->rate_1;
        $shipmentRate->rate_2 = $request->rate_2;
        $shipmentRate->save();

        return $shipmentRate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShipmentRate  $shipmentRate
     * @return \Illuminate\Http\Response
     *      * @param  \Illuminate\Http\Request  $request
 
     */
    public function destroy(ShipmentRate $shipmentRate, Request $request)
    {

        $rate = ShipmentRate::findOrFail($request->id);
        $rate->delete();
        return response()->json(null,204);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $rate = ShipmentRate::findOrFail($request->id);
        $rate->delete();
        return response()->json(null,204);
    }
}
