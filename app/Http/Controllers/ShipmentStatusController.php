<?php

namespace App\Http\Controllers;

use App\ShipmentStatus;
use App\Shipment;
use App\User;
use Illuminate\Http\Request;

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

            // return $request;
              // Handle File Upload
// //    if($request->hasFile('document')){
//     // Get filename with the extension
//     $filenameWithExt = $request->file('document')->getClientOriginalName();
//     // Get just filename
//     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
//     // Get just ext
//     $extension = $request->file('document')->getClientOriginalExtension();
//     // Filename to store
//     $fileNameToStore= $filename.'_'.time().'.'.$extension;
//     // Upload Image
//     $path = $request->file('document')->storeAs('public/documents', $fileNameToStore);
// // } 
// // else {
// //     $fileNameToStore = 'noimage.jpg';
// // }

        
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

        // send mail
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
                // ->cc('gurukallogistics@gmail.com')
                ->subject('About Your Shipment');
        });

       
            $beautymail->send('emails.shipment.sender_2', compact('docket','status','shipment'), function($message) use($sender2)
            {
                $message
                    ->from('admin@gurukal.co.in', 'Gurukal Logistics')
                    ->to($sender2->email,$sender2->name)
                    ->subject('About Your Shipment');
            });
     

            return response()->json( $status,200);
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
