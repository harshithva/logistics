<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Shipment;
use App\Quote;
use App\Payment;
use App\ShipmentStatus;
use Carbon\Carbon;
use App\Http\Resources\Customer as CustomerResource;
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


        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
   
        $beautymail->send('emails.customer.created', compact('request'), function($message) use($request)
        {
            $message
                ->from('admin@gurukal.co.in', 'Gurukal Logistics')
                ->to($request->email,$request->name)
                ->cc('gurukallogistics@gmail.com')
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
            'password'=>'max:255',
            'gst'=>'max:255',
            'address'=>'max:500',
            'phone'=>'max:255',
            'company_name'=>'max:255',
        ]);
        $customer = User::findOrFail($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        if($request->password !== "")
        {
            $customer->password = $request->password;
        }
        $customer->company_name = $request->company_name;
        $customer->gst = $request->gst;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->user_notes = $request->user_notes;
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
        $advance_paid = $customer->shipment->sum('charge_advance_paid');
        $customer->paid_invoice = Payment::where('customer_id',$id)->sum('amount') + $advance_paid;
       $customer->outstanding_invoice =$customer->shipment->sum('charge_total') -  $customer->paid_invoice;
       $customer->total_invoice = $customer->shipment->count();
      
       foreach($customer->shipment as $item)
       {
        $item->total_paid = $item->payment->sum('amount');
        $item->shipment_status =  $item->status;
       }
        // $customer->shipment_status = $shipment->status->sortByDesc('created_at')->first();
       
        return response()->json($customer,200);
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
        $pending = 0;
        $shipments = Shipment::all();
        foreach ($shipments as $key => $shipment) {
            if($shipment->status->status != 'Delivered'){
                $pending++;
            }
        }

        $pending_payment = Shipment::sum('charge_total') - (Shipment::sum('charge_advance_paid') +  Payment::sum('amount'));
      
        $advance = Shipment::sum('charge_advance_paid') + Payment::sum('amount');
       $data =  (object) ['earnings' =>    $advance,
    'customers' => User::where('role','customer')->count(),
    'quotations' =>  Quote::count(),
    'shipments' =>  Shipment::count(),
    'pending_delivery' => $pending,
    'pending_payment' => $pending_payment
    ];

    $data->overview = $overview;
        return response()->json($data, 200);
    }
}
