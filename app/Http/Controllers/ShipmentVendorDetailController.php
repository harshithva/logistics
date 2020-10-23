<?php

namespace App\Http\Controllers;

use App\ShipmentVendorDetail;
use Illuminate\Http\Request;
use App\User;

use App\Http\Resources\ShipmentVendorDetail as ShipmentVendorDetailResource;
use App\Http\Resources\VendorShipment as VendorShipmentResource;
use App\Http\Resources\Customer as CustomerResource;

class ShipmentVendorDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $vendor_details = ShipmentVendorDetail::all();
       return ShipmentVendorDetailResource::collection($vendor_details);
    }

    public function all_vendors()
    {
        $vendors = User::where('role','vendor')->get();
        return CustomerResource::collection($vendors);
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
            'vendor_id' => 'required|max:255',
            'shipment_id' => 'required|max:255',
            ]);
        
            $vendor =  new ShipmentVendorDetail;
            $vendor->shipment_id = $request->shipment_id;
            $vendor->vendor_id = $request->vendor_id;
            $vendor->save();
            return new VendorResource($vendor);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\ShipmentVendorDetail  $shipmentVendorDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ShipmentVendorDetail $shipmentVendorDetail)
    {
        //
    }

    public function vendor_shipments($id)
    {
        $vendor = User::findOrFail($id);
        return new VendorShipmentResource($vendor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShipmentVendorDetail  $shipmentVendorDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipmentVendorDetail $shipmentVendorDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShipmentVendorDetail  $shipmentVendorDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'vendor_id' => 'required|max:255',
            'shipment_id' => 'required|max:255',
            ]);
        
            $vendor->shipment_id = $request->shipment_id;
            $vendor->vendor_id = $request->vendor_id;
            $vendor->save();
            return new ShipmentVendorDetailResource($vendor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShipmentVendorDetail  $shipmentVendorDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return response()->json(null,204);
    }
}
