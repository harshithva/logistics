<?php

namespace App\Http\Controllers;

use App\ShipmentStatus;
use App\Shipment;
use App\User;
use Illuminate\Http\Request;
use App\Events\ShipmentUpdatedEvent;

class ShipmentStatusController extends Controller
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
            'status' => 'max:255',
            'customer_id' => 'required|max:255',
            'shipment_id' => 'required|max:255',
            'location' => 'max:255',
            'receiver_name' => 'max:255',
            'phone' => 'max:255',
            ]);

        
            $status = new ShipmentStatus;
            $status->status = $request->status;
            $status->location = $request->location;
            //  $status->document = $fileNameToStore;    
            $status->receiver_name = $request->receiver_name;
            $status->phone = $request->phone;
            $status->customer_id = $request->customer_id;
            $status->shipment_id = $request->shipment_id;
            $status->save();



            // send sms
            $shipment = Shipment::findOrFail($request->shipment_id);
            event(new ShipmentUpdatedEvent($shipment));
     
            return response()->json($status,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShipmentStatus  $shipmentStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ShipmentStatus $shipmentStatus)
    {
        return response()->json($shipmentStatus,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShipmentStatus  $shipmentStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipmentStatus $shipmentStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShipmentStatus  $shipmentStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipmentStatus $shipmentStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShipmentStatus  $shipmentStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipmentStatus $shipmentStatus)
    {
        //
    }

    private function storeImage($image)
    {
        if($request->hasFile($image)){
            // Get filename with the extension
            $filenameWithExt = $request->file($image)->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file($image)->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file($image)->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        return $fileNameToStore;
    }
}
