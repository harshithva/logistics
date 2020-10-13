<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Resources\Vendor as VendorResource;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();
        return VendorResource::collection($vendors);
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
        
            $vendor =  new Vendor;
            $vendor->shipment_id = $request->shipment_id;
            $vendor->vendor_id = $request->vendor_id;
            $vendor->save();
            return new VendorResource($vendor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        return new VendorResource($vendor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vendor  $vendor
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
            return new VendorResource($vendor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return response()->json(null,204);
    }
}
