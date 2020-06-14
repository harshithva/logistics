<?php

namespace App\Http\Controllers;

use App\Quote;
use App\QuoteList;
use Illuminate\Http\Request;

use Snowfire\Beautymail\Beautymail;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::with('customer','list')->get();
        return response()->json($quotes,200);
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
        $quote = new Quote;
        $quote->customer_id = $request->customer_id;
        $quote->save();

        $my_id = sprintf('%04d', $quote->id);
        $quotation_no = 'GLQ' .  $my_id;
        $quote->quotation_no = $quotation_no;
        $quote->save();
        
        $request->quotations = json_encode($request->quotations);
        $request->quotations = json_decode($request->quotations);

        foreach($request->quotations as $quotation)
        {
            $quotelist = new QuoteList;
            $quotelist->from = $quotation->from;
            $quotelist->to = $quotation->to;
            $quotelist->description = $quotation->description;
            $quotelist->size = $quotation->size;
            $quotelist->weight = $quotation->weight;
            $quotelist->eta= $quotation->eta;
            $quotelist->rate= $quotation->rate;
            $quotelist->advance= $quotation->advance;
            $quotelist->quote_id= $quote->id;
            $quotelist->save();
        }
        return response()->json($quote,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
      
        $quote = Quote::find($request);
        $quote->customer;
        $quote->list;
        return response()->json($quote,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function edit(Quote $quote)
    {

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quote $quote)
    {
        $quote = Quote::findOrFail($request->id);
        $quote->customer_id = $request->customer_id; 
        $quote->quotation_no = $request->quotation_no;
        $quote->status = $request->status;
        $quote->save();
        
        $request->list= json_encode($request->list);
        $request->list= json_decode($request->list);

        QuoteList::where('quote_id', $request->id)->delete();
        foreach($request->list as $quotation)
        {
            $quotelist = new QuoteList;
            $quotelist->from = $quotation->from;
            $quotelist->to = $quotation->to;
            $quotelist->description = $quotation->description;
            $quotelist->size = $quotation->size;
            $quotelist->weight = $quotation->weight;
            $quotelist->eta= $quotation->eta;
            $quotelist->rate= $quotation->rate;
            $quotelist->advance= $quotation->advance;
            $quotelist->quote_id= $quote->id;
            $quotelist->save();
        }

        return response()->json($quote,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        //
    }

    
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve_status($request)
    {
     $quote = Quote::find($request);
     $quote->status = 'approved';
     $quote->save();
    }

    public function decline_status($request)
    {
     $quote = Quote::find($request);
     $quote->status = 'declined';
     $quote->save();
    }


    public function quote_send_email($request)
    {
        $quote = Quote::find($request);
        // $quote->customer;
        // $quote->list;
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);

        $beautymail->send('emails.quotes.quote', compact('quote'), function($message)
        {
            $message
                ->from('crm@gurukal.co.in')
                ->to('harshith11032001@gmail.com', 'John Smith')
                ->subject('Welcome!');
        });
    }
}
