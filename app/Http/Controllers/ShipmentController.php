<?php

namespace App\Http\Controllers;
use App\Mail\ShipmentCreated;

use Mail;
use App\Shipment;
use App\User;
use App\Package;
use App\ShipmentVendorDetail;
use App\Payment;
use App\ShipmentStatus;
use App\ShipmentInsurance;
use App\Http\Resources\Shipment as ShipmentResource;
use App\Http\Resources\ShipmentSingle as ShipmentSingleResource;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Snowfire\Beautymail\Beautymail;


class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $shipments = Shipment::all();

        foreach ($shipments as $key => $shipment) {
        
            $total_paid = $shipment->payment->sum('amount');
            
            if($total_paid > 0)
            {
                $balance_amount = ($shipment->charge_total - $total_paid) -  $shipment->charge_advance_paid;
            }
        else {
            $balance_amount = ($shipment->charge_total -  $shipment->charge_advance_paid);
        }
            $shipment->balance_amount = $balance_amount;

        }

        
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
            "delivery_address" => "max:255",
            "receiver_id" => "required|max:255",
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
            "charge_total" => "max:255|required",
            "sender_id"=>"required|max:255",
            "remarks" => 'max:500',
            "bill_to" => 'max:500|required',
            "vendor_id" => 'max:500|required',
            "vendor_total" => 'max:500|required',
            "vendor_advance" => 'max:500|required',
           
        ]);
 
       
        $shipment = new Shipment;
       
        $shipment->receiver_id = $request->receiver_id;
      
        $shipment->delivery_address = $request->delivery_address;
   

        $shipment->package_contact_person = $request->package_contact_person;
        $shipment->package_contact_person_phone = $request->package_contact_person_phone;
        $shipment->package_transaction_type = $request->package_transaction_type;
        $shipment->package_pickup_address = $request->package_pickup_address;

        $shipment->transport_company_name = $request->transport_company_name;
        $shipment->transport_company_phone = $request->transport_company_phone;
        $shipment->transport_driver_name = $request->transport_driver_name;
        $shipment->transport_driver_phone = $request->transport_driver_phone;
        $shipment->transport_driver_vehicle = $request->transport_driver_vehicle;
        $shipment->package_pickup_address = $request->package_pickup_address;
        $shipment->package_pickup_address = $request->package_pickup_address;

        $shipment->user_notes = $request->user_notes;
    
        $shipment->charge_transportation = $request->charge_transportation;
        $shipment->charge_handling = $request->charge_handling;
        $shipment->charge_halting = $request->charge_halting;
        $shipment->charge_Insurance = $request->charge_Insurance;
        $shipment->user_notes = $request->user_notes;
        $shipment->charge_odc = $request->charge_odc;
        $shipment->charge_tax_percent = $request->charge_tax_percent;
        $shipment->charge_tax_amount = $request->charge_tax_amount;
        $shipment->charge_total = $request->charge_total;
        $shipment->charge_advance_paid = $request->charge_advance_paid;
        $shipment->charge_balance = $request->charge_balance;

       
        $shipment->payment_type = $request->payment_type;
        $shipment->sender_id = $request->sender_id;
        $shipment->remarks = $request->remarks;
        $shipment->bill_to = $request->bill_to;
      


        if($request->bill_to == 'consignor')
        {
            $shipment->bill_to_id = $request->sender_id;
        }

        else if($request->bill_to == 'consignee')
        {
            $shipment->bill_to_id = $request->receiver_id;
        }

        else
        {
            $shipment->bill_to_id = $request->sender_id;
        }
        
        if($request->date)
        {
            $shipment->date = $request->date;
        }
        else{
            $shipment->date = Carbon::now();
        }
       
                // Handle File Upload
        if($request->hasFile('document')){
            // Get filename with the extension
            $filenameWithExt = $request->file('document')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('document')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('document')->storeAs('public/documents', $fileNameToStore);
            
            $shipment->document = $fileNameToStore;
        } 

     


        $shipment->save();
        $my_id = sprintf('%04d', $shipment->id);
        $freight_invoice_no = 'GLCRM202021' .  $my_id;
        $docket_no = 'GLBNG' . $my_id;
        $shipment->docket_no = $docket_no;
        $shipment->freight_invoice_number = $freight_invoice_no;
        $shipment->save();
   
        $request->package = json_encode($request->package);
        $request->package = json_decode($request->package);
        if($request->package){
            foreach($request->package as $data)
            {
                $package = new Package;
           
                $package->description = $data->description;
                $package->serial_no = $data->serial_no;
                $package->invoice_no = $data->invoice_no;
                $package->size = $data->size;
                $package->weight = $data->weight;
                $package->quantity = $data->quantity;
                $package->cost = $data->cost;
                $package->shipment_id = $shipment->id;
                $package->save();
            }
          
        }
        $request->insurance = json_encode($request->insurance);
        $request->insurance = json_decode($request->insurance);
        if($request->insurance){
            foreach($request->insurance as $data)
            {
                $insurance = new ShipmentInsurance;
           
                $insurance->eway_bill = $data->eway_bill;
                $insurance->insurance_no = $data->insurance_no;
                $insurance->insurance_agent = $data->insurance_agent;
                $insurance->shipment_id = $shipment->id;
                $insurance->save();
            }
          
        }
        // vendor
        $vendor = new ShipmentVendorDetail;
        $vendor->shipment_id = $shipment->id;
        $vendor->vendor_id = $request->vendor_id;
        $vendor->total = $request->vendor_total;
        $vendor->advance = $request->vendor_advance;
        $vendor->save();


        $shipment_status = new ShipmentStatus;
        $shipment_status->status = 'Awaiting Pickup';
        $shipment_status->shipment_id = $shipment->id;
        $shipment_status->customer_id= $request->sender_id;
        $shipment_status->save();
       
      
// send sms
     
        $sender =  $shipment->sender;
        $receiver =  $shipment->receiver;
     
        if($shipment->status == 'Awaiting Pickup' || $shipment->status == 'Awaiting pickup')
        {
            $msg = 'SHIPMENT CREATED Your Consignment is ready for dispatch with docket number '.$shipment->docket_no.' Login at gurukal.co.in Or track your consignment at Gurukal.co.in Regards Gurukal Logistics.';
        }else if($shipment->status->status == 'Dispatched') {
            $msg =  'SHIPMENT DISPATCHED Your Consignment with docket number '.$shipment->docket_no.'is Dispatched Login at gurukal.co.in Or track your consignment at Gurukal.co.in Regards Gurukal Logistics.';
        }else if($shipment->status->status == 'Delivered') {
            $msg =  'SHIPMENT DELIVERED Your Consignment with docket number '. $shipment->docket_no .' is DELIVERED Kindly let us know how was your experience by clicking the following link Gurukal.co.in/feedback Thank you. Regards Gurukal Logistics.';
        }
        else if($shipment->status->status == 'Intrasit' || $shipment->status->status == 'Intransit'){
           $msg = 'Hi, This Message is to inform you that your shipment with Docket number '. $shipment->docket_no . ' is Intransit. Regards Gurukal Logistics.';
        }
        else{
            $msg = 'Hi, This Message is to inform you that your shipment with Docket number '. $shipment->docket_no . ' has been successfully created. Regards Gurukal Logistics.';
         }
      
      
     
        $curl = curl_init();
        $authentication_key = '238341A2R5ezqRDIW5edd541bP1';

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{ \"sender\": \"GURUKL\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"$msg\", \"to\": [ \"$sender->phone\",\"$receiver->phone\" ] }] }",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTPHEADER => array(
            "authkey: $authentication_key",
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        return response()->json($shipment,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Shipment $shipment)
    {
    
       
        // $shipment->sender;
        // $shipment->package;
        // $shipment->receiver;
        // $shipment->payment;
        // $shipment->insurance;
        // $shipment->vendor;
        // $shipment->vendor_details;
        // return response()->json($shipment,200);
        return new ShipmentSingleResource($shipment);
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
         
        $request->validate([
            "delivery_address" => "max:255",
            "receiver_id" => "required|max:255",
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
            "sender_id"=>"required|max:255",
            "remarks" => 'max:500',
            "bill_to" => 'max:500',
            "vendor_id" => 'max:500|required',
            "vendor_total" => 'max:500|required',
            "vendor_advance" => 'max:500|required',
        ]);

      
       
        $shipment->receiver_id = $request->receiver_id;
      
        $shipment->delivery_address = $request->delivery_address;
   

        $shipment->package_contact_person = $request->package_contact_person;
        $shipment->package_contact_person_phone = $request->package_contact_person_phone;
        $shipment->package_transaction_type = $request->package_transaction_type;
        $shipment->package_pickup_address = $request->package_pickup_address;

        $shipment->transport_company_name = $request->transport_company_name;
        $shipment->transport_company_phone = $request->transport_company_phone;
        $shipment->transport_driver_name = $request->transport_driver_name;
        $shipment->transport_driver_phone = $request->transport_driver_phone;
        $shipment->transport_driver_vehicle = $request->transport_driver_vehicle;
        $shipment->package_pickup_address = $request->package_pickup_address;
        $shipment->package_pickup_address = $request->package_pickup_address;

        $shipment->user_notes = $request->user_notes;
    
        $shipment->charge_transportation = $request->charge_transportation;
        $shipment->charge_handling = $request->charge_handling;
        $shipment->charge_halting = $request->charge_halting;
        $shipment->charge_Insurance = $request->charge_Insurance;
        $shipment->user_notes = $request->user_notes;
        $shipment->charge_odc = $request->charge_odc;
        $shipment->charge_tax_percent = $request->charge_tax_percent;
        $shipment->charge_tax_amount = $request->charge_tax_amount;
        $shipment->charge_total = $request->charge_total;
        $shipment->charge_advance_paid = $request->charge_advance_paid;
        $shipment->charge_balance = $request->charge_balance;

        $shipment->vendor = $request->vendor;
        $shipment->payment_type = $request->payment_type;
        $shipment->sender_id = $request->sender_id;
        $shipment->remarks = $request->remarks;
        $shipment->bill_to = $request->bill_to;
       
        if($request->bill_to == 'consignor')
        {
            $shipment->bill_to_id = $request->sender_id;
        }

        else if($request->bill_to == 'consignee')
        {
            $shipment->bill_to_id = $request->receiver_id;
        }

        else
        {
            $shipment->bill_to_id = $request->sender_id;
        }
        

        $shipment->docket_no = $request->docket_no;
        $shipment->freight_invoice_number = $request->freight_invoice_number;
        $shipment->date = $request->date;
        $shipment->save();
     

        $request->package = json_encode($request->package);
        $request->package = json_decode($request->package);

        Package::where('shipment_id', $shipment->id)->delete();
        if($request->package){
            foreach($request->package as $data)
            {
                $package = new Package;
           
                $package->description = $data->description;
                $package->serial_no = $data->serial_no;
                $package->invoice_no = $data->invoice_no;
                $package->size = $data->size;
                $package->weight = $data->weight;
                $package->quantity = $data->quantity;
                $package->cost = $data->cost;
                $package->shipment_id = $shipment->id;
                
                $package->save();
            }
          
        }


        $request->insurance = json_encode($request->insurance);
        $request->insurance = json_decode($request->insurance);

        ShipmentInsurance::where('shipment_id', $shipment->id)->delete();
        if($request->insurance){
            foreach($request->insurance as $data)
            {
                
                $insurance= new ShipmentInsurance;
                $insurance->eway_bill = $data->eway_bill;
                $insurance->insurance_no = $data->insurance_no;
                $insurance->insurance_agent = $data->insurance_agent;
                $insurance->shipment_id = $shipment->id;
                $insurance->save();
         
            }
          
        }

          // vendor
          $vendor = ShipmentVendorDetail::where('shipment_id', $shipment->id)->get();
          $vendor->shipment_id = $shipment->id;
          $vendor->vendor_id = $request->vendor_id;
          $vendor->total = $request->vendor_total;
          $vendor->advance = $request->vendor_advance;
          $vendor->save();

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

    public function balance_amount($id)
    {
        $shipment = Shipment::findOrFail($id);
        $total_paid = $shipment->payment->sum('amount');
        if($total_paid > 0)
        {
            $balance_amount = ($shipment->charge_total - $total_paid) -  $shipment->charge_advance_paid;
        }
      else {
        $balance_amount = ($shipment->charge_total -  $shipment->charge_advance_paid);
      }
        $object = new \stdClass();;
        $object->balance_amount = $balance_amount;
        return response()->json( $object ,200);
    }

    public function shipment_status($id) {
        $shipment = Shipment::findOrFail($id);
        
        return response()->json( $shipment->status ,200);
    }

    public function shipment_send_email($id) {

        $shipment = Shipment::findOrFail($id);
        if($shipment->bill_to == 'consignor')
        {
            $sender2 =  $shipment->receiver;
        }else {
            $sender2 =  $shipment->sender;
        }
 
        $sender =  User::findOrFail($shipment->bill_to_id);
        $docket = $shipment->docket_no;
        $status =  $shipment->status->status;
        
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
   
        $beautymail->send('emails.shipment.bill_to', compact('docket','status','shipment'), function($message) use($sender)
        {
            $message
                ->from('admin@gurukal.co.in', 'Gurukal Logistics')
                ->to($sender->email,$sender->name)
                // ->to('bennykgallagher@outlook.com')
                ->cc('gurukallogistics@gmail.com')
                ->subject('About Your Shipment');
        });

       
            $beautymail->send('emails.shipment.sender_2', compact('docket','status','shipment'), function($message) use($sender2)
            {
                $message
                    ->from('admin@gurukal.co.in', 'Gurukal Logistics')
                    ->to($sender2->email,$sender2->name)
           
                    ->subject('About Your Shipment');
            });
     
       

        return response()->json('sent',200);
    }

    public function shipment_send_docket($id) {
        $shipment = Shipment::findOrFail($id);
        $sender =  $shipment->sender;
        $receiver =  $shipment->receiver;
 

        $docket = $shipment->docket_no;
        $status =  $shipment->status->status;
        
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
   
        $beautymail->send('emails.shipment.docket', compact('shipment'), function($message) use($sender,$receiver)
        {
            $message
                ->from('admin@gurukal.co.in', 'Gurukal Logistics')
                ->to($sender->email,$sender->name)
                ->cc('gurukallogistics@gmail.com')
            
                ->cc($receiver->email)
                ->subject('About Your Shipment');
        });

        return response()->json('sent',200);
    }

    public function shipment_track($tracking_no) {
        $shipment = Shipment::where('docket_no',$tracking_no)->first(); 
        $shipment->track;
        return response()->json($shipment,200);
    }


    public function shipment_send_sms($id) {
        $shipment = Shipment::findOrFail($id); 
        $sender =  User::findOrFail($shipment->bill_to_id);
        $receiver =  $shipment->receiver;
     
        if($shipment->status == 'Awaiting Pickup' || $shipment->status == 'Awaiting pickup')
        {
            $msg = 'SHIPMENT CREATED Your Consignment is ready for dispatch with docket number '.$shipment->docket_no.' Login at gurukal.co.in Or track your consignment at Gurukal.co.in Regards Gurukal Logistics.';
        }else if($shipment->status->status == 'Dispatched') {
            $msg =  'SHIPMENT DISPATCHED Your Consignment with docket number '.$shipment->docket_no.'is Dispatched Login at gurukal.co.in Or track your consignment at Gurukal.co.in Regards Gurukal Logistics.';
        }else if($shipment->status->status == 'Delivered') {
            $msg =  'SHIPMENT DELIVERED Your Consignment with docket number '. $shipment->docket_no .' is DELIVERED Kindly let us know how was your experience by clicking the following link Gurukal.co.in/feedback Thank you. Regards Gurukal Logistics.';
        }
        else if($shipment->status->status == 'Intrasit' || $shipment->status->status == 'Intransit'){
           $msg = 'Hi, This Message is to inform you that your shipment with Docket number '. $shipment->docket_no . ' is Intransit. Regards Gurukal Logistics.';
        }
        else{
            $msg = 'Hi, This Message is to inform you that your shipment with Docket number '. $shipment->docket_no . ' has been successfully created. Regards Gurukal Logistics.';
         }
      
      
     
        $curl = curl_init();
        $authentication_key = '238341A2R5ezqRDIW5edd541bP1';

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.msg91.com/api/v2/sendsms",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{ \"sender\": \"GURUKL\", \"route\": \"4\", \"country\": \"91\", \"sms\": [ { \"message\": \"$msg\", \"to\": [ \"$sender->phone\",\"$receiver->phone\" ] }] }",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTPHEADER => array(
            "authkey: $authentication_key",
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

    }

    public function view_invoice($request) {
        $shipment = Shipment::find($request);
        $shipment->sender;
        $shipment->package;
        $shipment->receiver;
        $shipment->payment;

        $total_paid = $shipment->payment->sum('amount');
        if($total_paid > 0)
        {
            $balance = ($shipment->charge_total - $total_paid) -  $shipment->charge_advance_paid;
        }
      else {
        $balance = ($shipment->charge_total -  $shipment->charge_advance_paid);
      }

      $shipment->qrcode = "https://crm.gurukal.in/customer/docket/8jZSqbGNmzk25EcBgMsWYyDP4LDEAS7amrVevmqcTE67ByuajGaks8UqmLmJ/$shipment->id/urMrnM6JNuGPCnEdnmDqzfWfDYAUSYb8rkveHF9mWGPgD2XxH4SYRXjRCnmx/view";
    //   dd($balance);
      $balance_amount = new \stdClass();
      $balance_amount->balance_amount = $balance;
        return view('invoice',compact('shipment', 'balance_amount'));
    }

    public function view_docket($request) {
  
        
        $shipment = Shipment::find($request);
          
        $shipment->sender;
        $shipment->package;
        $shipment->receiver;
        $shipment->payment;
        $shipment->insurance;
        // qrcode link
        $shipment->qrcode = "https://crm.gurukal.in/customer/docket/8jZSqbGNmzk25EcBgMsWYyDP4LDEAS7amrVevmqcTE67ByuajGaks8UqmLmJ/$shipment->id/urMrnM6JNuGPCnEdnmDqzfWfDYAUSYb8rkveHF9mWGPgD2XxH4SYRXjRCnmx/view";
        return view('docket',compact('shipment'));
    }

    public function feedback($id){
        $shipment = Shipment::find($id);

        return view('feedback',compact('shipment'));
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send_feedback(Request $request){
    
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
   
        $beautymail->send('emails.shipment.feedback',compact('request'), function($message)
        {
            $message
                ->from('admin@gurukal.co.in', 'Gurukal Logistics')
                ->to('gurukallogistics@gmail.com','Gurukal Logistics')

                ->subject('Feeback');
        });

        return response()->json('sent',200);
    }
       
}
