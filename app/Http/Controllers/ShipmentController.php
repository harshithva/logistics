<?php

namespace App\Http\Controllers;

use App\Shipment;
use App\Package;
use App\Http\Resources\Shipment as ShipmentResource;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::paginate(15);
        return ShipmentResource::collection($shipments);
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
            "receiver_name" => "required|max:255",
            "receiver_company"=> "required|max:255",
            "receiver_gst" => "max:255",
            "receiver_email" => "max:255",
            "receiver_phone" => "required|max:255",
            "receiver_secondary_phone" => "max:255",
            "receiver_address" => "max:500",
            "receiver_delivery_address" => "max:500",
            "receiver_note"=> "max:500",
            "receiver_state" => "max:255",
            "receiver_pincode" => "required|max:255",
            "package_contact_person" => "max:255",
            "package_contact_person_phone" => "max:255",
            "package_transaction_type" => "max:255",
            "package_pickup_address"=> "max:500",
            "transport_company_name"=> "max:255",
            "transport_company_phone"=> "max:255",
            "transport_driver_name"=> "max:255",
            "transport_driver_phone"=> "max:255",
            "transport_driver_vehicle" => "max:255",
            "user_notes"=> "max:500",
            "freight_invoice_number"=> "max:500",
            "charge_transportation"=> "max:255",
            "charge_handling"=> "max:255",
            "charge_halting"=> "max:255",
            "charge_Insurance"=> "max:255",
            "charge_odc"=> "max:255",
            "charge_tax_percent"=> "max:255",
            "charge_tax_amount" => "max:255",
            "charge_total" => "max:255",
            "customer_id"=>"required|max:255",
        ]);

        $shipment = new Shipment;
        $shipment->receiver_name = $request->receiver_name;
        $shipment->receiver_company = $request->receiver_company;
        $shipment->receiver_gst = $request->receiver_gst;
        $shipment->receiver_email = $request->receiver_email;
        $shipment->receiver_phone = $request->receiver_phone;
        $shipment->receiver_secondary_phone = $request->receiver_secondary_phone;
        $shipment->receiver_address = $request->receiver_address;
        $shipment->receiver_delivery_address = $request->receiver_delivery_address;
        $shipment->receiver_note = $request->receiver_note;
        $shipment->receiver_pincode = $request->receiver_pincode;

        $shipment->package_contact_person = $request->package_contact_person;
        $shipment->package_contact_person_phone = $request->package_contact_person_phone;
        $shipment->package_transaction_type = $request->package_transaction_type;
        $shipment->package_pickup_address = $request->package_pickup_address;

        $shipment->transport_company_name = $request->transport_company_name;
        $shipment->transport_company_phone = $request->transport_company_phone;
        $shipment->transport_driver_phone = $request->transport_driver_phone;
        $shipment->transport_driver_vehicle = $request->transport_driver_vehicle;
        $shipment->package_pickup_address = $request->package_pickup_address;
        $shipment->package_pickup_address = $request->package_pickup_address;

        $shipment->user_notes = $request->user_notes;
        $shipment->freight_invoice_number = $request->freight_invoice_number;
        $shipment->charge_transportation = $request->charge_transportation;
        $shipment->charge_handling = $request->charge_handling;
        $shipment->charge_halting = $request->charge_halting;
        $shipment->charge_Insurance = $request->charge_Insurance;
        $shipment->user_notes = $request->user_notes;
        $shipment->charge_odc = $request->charge_odc;
        $shipment->charge_tax_percent = $request->charge_tax_percent;
        $shipment->charge_tax_amount = $request->charge_tax_amount;
        $shipment->charge_total = $request->charge_total;
        $shipment->customer_id = $request->customer_id;
        $shipment->save();
        
        $request->packages = json_encode($request->packages);
        $request->packages = json_decode($request->packages);
        if($request->packages){
            foreach($request->packages as $data)
            {
                $package = new Package;
                $package->name = $data->name;
                $package->description = $data->description;
                $package->serial_no = $data->serial_no;
                $package->invoice_no = $data->invoice_no;
                $package->size = $data->size;
                $package->weight = $data->weight;
                $package->cost = $data->cost;
                $package->shipment_id = $shipment->id;
                $package->save();
            }
          
        }
       
      
        return response()->json($shipment,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        return new ShipmentResource($shipment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        $shipment->update($request->all());
        return response()->json($shipment,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return response()->json(null,204);
    }
}
