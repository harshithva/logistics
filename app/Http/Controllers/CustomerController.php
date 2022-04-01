<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Shipment;
use App\Quote;
use App\Payment;
use App\ShipmentStatus;
use App\ShipmentVendorDetail;
use App\VendorPayment;
use Carbon\Carbon;
use Helpers;
use App\Http\Resources\Customer as CustomerResource;
use App\Http\Resources\CustomerInvoice as CustomerInvoiceResource;
use Snowfire\Beautymail\Beautymail;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::where('role','customer')->get();
        return CustomerResource::collection($customers);
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_customer_details(Request $request)
    {
        $pending_shipments=0;
        $delivered_shipments=0;
       
        $shipments = Shipment::where("sender_id", $request->id)->get();
        foreach ($shipments as $key => $shipment) {
            if($shipment->status->status == 'Delivered'){
                $delivered_shipments++;
            }
        }
        foreach ($shipments as $key => $shipment) {
            if($shipment->status->status == 'Dispatched' || $shipment->status->status == 'Intransit' || $shipment->status->status == "Awaiting Pickup"){
                $pending_shipments++;
            }
        }

        $total_shipments = Shipment::where("sender_id", $request->id)->count();
        return [
            "total_shipments" => $total_shipments,
            "delivered_shipments" => $delivered_shipments,
            "pending_shipments" => $pending_shipments
        ];
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
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|max:255',
            'gst'=>'max:255',
            'address'=>'max:500',
            'phone'=>'max:255',
            'company_name'=>'max:255',
        ]);
       
        $customer = User::create($request->all());
        if($request->show_rates) {
            $customer->show_rates = $request->show_rates;
        }else {
             $customer->show_rates = 0; 
        }
      
     
        $customer->save();
        


        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
   
        $beautymail->send('emails.customer.created', compact('request'), function($message) use($request)
        {
            $message
                ->from('admin@gurukal.co.in', 'Gurukal Logistics')
                ->to($request->email,$request->name)
                // ->to("virtualarts123@gmail.com")
                // ->cc('gurukallogistics@gmail.com')
                ->subject('Account created');
        });

        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $customer = User::findOrFail($id);
       $customer->show_rates = $customer->show_rates ? true:false;
       return new CustomerResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
        
            'gst'=>'max:255',
            'address'=>'max:500',
            'phone'=>'max:255',
            'company_name'=>'max:255',
        ]);
        $customer = User::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
      
        $customer->company_name = $request->company_name;
        $customer->gst = $request->gst;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->user_notes = $request->user_notes;
        $customer->show_rates = $request->show_rates;
        $customer->save();
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();
        return response()->json(null,204);
    }


    public function get_customer_invoices($id)
    {
        $customer = User::findOrFail($id);
        // $customer->shipment->sum('charge_total');
    //    $advance_paid = $customer->shipment->sum('charge_advance_paid');
    //    $customer->paid_invoice = Payment::where('customer_id',$id)->sum('amount') + $advance_paid;
    //    $customer->outstanding_invoice =$customer->shipment->sum('charge_total') -  $customer->paid_invoice;
    //    $customer->total_invoice = $customer->shipment->count();
      
    //    foreach($customer->shipment as $item)
    //    {
    //     $item->total_paid = $item->payment->sum('amount');
    //     $item->shipment_status =  $item->status;
    //    }
       
    //     return response()->json($customer,200);

    $customer = User::findOrFail($id);
      $customer->type = 'all' ;
        return new CustomerInvoiceResource($customer);
    }

    public function get_customer_paid_invoices($id)
    {
        
       $customer = User::findOrFail($id);
      $customer->type = 'paid' ;
        return new CustomerInvoiceResource($customer);
    }

    public function get_customer_partial_invoices($id)
    {
        
       $customer = User::findOrFail($id);
      $customer->type = 'partial' ;
        return new CustomerInvoiceResource($customer);
    }
    
    public function get_customer_pending_invoices($id)
    {
        
       $customer = User::findOrFail($id);
      $customer->type = 'pending' ;
        return new CustomerInvoiceResource($customer);
    }



    public function get_customer_quotes($id)
    {
        $customer = User::findOrFail($id);
        // $customer->shipment->sum('charge_total');
        $customer->quote_count = $customer->quote->count();
        $customer->quote_approved_count = $customer->quote->where('status','approved')->count();
        $customer->quote_approved_declined = $customer->quote->where('status','declined')->count();
    
        foreach($customer->quote as $item)
        {
         $item->from =  $item->list->first()->from;
         $item->to =  $item->list->first()->to;
        }
       
        return response()->json($customer,200);
    }

    public function dashboard()
    {

        $overview = [
          ['Sun', Shipment::whereDate('created_at',Carbon::parse('last sunday')->startOfDay())->sum('charge_total')],
          ['Mon' ,Shipment::whereDate('created_at',Carbon::parse('last monday')->startOfDay())->sum('charge_total')],
          ['Tue' , Shipment::whereDate('created_at',Carbon::parse('last tuesday')->startOfDay())->sum('charge_total')],
          ['Wed' ,Shipment::whereDate('created_at',Carbon::parse('last wednesday')->startOfDay())->sum('charge_total')],
          ['Thu' ,Shipment::whereDate('created_at',Carbon::parse('last thursday')->startOfDay())->sum('charge_total')],
          ['Fri', Shipment::whereDate('created_at',Carbon::parse('last friday')->startOfDay())->sum('charge_total')],
          ['Sat', Shipment::whereDate('created_at',Carbon::parse('last saturday')->startOfDay())->sum('charge_total')],
        ];
 
        $payments_overview = [
            ['Sun', Payment::whereDate('created_at',Carbon::parse('last sunday')->startOfDay())->sum('amount') + Shipment::whereDate('created_at',Carbon::parse('last sunday')->startOfDay())->sum('charge_advance_paid')],
            ['Mon' ,Payment::whereDate('created_at',Carbon::parse('last monday')->startOfDay())->sum('amount') + Shipment::whereDate('created_at',Carbon::parse('last monday')->startOfDay())->sum('charge_advance_paid')],
            ['Tue' , Payment::whereDate('created_at',Carbon::parse('last tuesday')->startOfDay())->sum('amount') + Shipment::whereDate('created_at',Carbon::parse('last tuesday')->startOfDay())->sum('charge_advance_paid')],
            ['Wed' ,Payment::whereDate('created_at',Carbon::parse('last wednesday')->startOfDay())->sum('amount') + Shipment::whereDate('created_at',Carbon::parse('last wednesday')->startOfDay())->sum('charge_advance_paid')],
            ['Thu' ,Payment::whereDate('created_at',Carbon::parse('last thursday')->startOfDay())->sum('amount') + Shipment::whereDate('created_at',Carbon::parse('last thursday')->startOfDay())->sum('charge_advance_paid')],
            ['Fri', Payment::whereDate('created_at',Carbon::parse('last friday')->startOfDay())->sum('amount') + Shipment::whereDate('created_at',Carbon::parse('last friday')->startOfDay())->sum('charge_advance_paid')],
            ['Sat', Payment::whereDate('created_at',Carbon::parse('last saturday')->startOfDay())->sum('amount') + Shipment::whereDate('created_at',Carbon::parse('last saturday')->startOfDay())->sum('charge_advance_paid')],
        ];
        $pending = 0;
        $shipments = Shipment::all();
        foreach ($shipments as $key => $shipment) {
            if($shipment->status->status != 'Delivered'){
                $pending++;
            }
        }

        $pending_payment = Shipment::sum('charge_total') - (Shipment::sum('charge_advance_paid') +  Payment::sum('amount')) - Shipment::sum('tds_amount');
      
        // $earnings = Shipment::sum('charge_advance_paid') + Payment::sum('amount') + Shipment::sum('tds_amount');
       
        $dateS = new Carbon("first day of April 2022");
        $dateE = new Carbon("first day of April 2023");
        $earnings = Shipment::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->sum('charge_advance_paid')
         + Payment::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"])->sum('amount') 
         + Shipment::sum('tds_amount');

        $upcoming_expense = ShipmentVendorDetail::sum('total') - (ShipmentVendorDetail::sum('advance') +VendorPayment::sum('amount'));

       $data =  (object) [
    'earnings' =>    $earnings,
    'customers' => User::where('role','customer')->count(),
    'quotations' =>  Quote::count(),
    'shipments' =>  Shipment::count(),
    'pending_delivery' => $pending,
    'pending_payment' => $pending_payment,
    'upcoming_expense' => $upcoming_expense,
    ];

    $data->overview = $overview;
    $data->payments_overview = $payments_overview;
        return response()->json($data, 200);
    }
}
