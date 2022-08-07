<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Shipment;
use App\Http\Resources\Package as PackageResource;
use Carbon\Carbon;
use Helpers;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::all();
        return PackageResource::collection($shipments);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_packages($customer_id, $month, $status)
    {
       $temp = $month;
       // status - paid, pending, partial;
        // get details to search
        $date = Carbon::now();
        $year = $date->year;
        $financial_year = env('CURRENT_FINANCIAL_YEAR');
        //current financial year
        $dateS = new Carbon("first day of April $financial_year");
        $dateE = new Carbon("last day of March ".$financial_year+1);
        //last financial year
        $lastYearDateS = new Carbon("first day of April ".$financial_year-1);
        $lastYearDateE = new Carbon("last day of March ".$financial_year);
        //2years financial year
        $lastTwoYearDateS = new Carbon("first day of April ".$financial_year-2);
        $lastTwoYearDateE = new Carbon("last day of March ".$financial_year-1);

                   if($month == 'this_month')
                    {
                        $month = $date->month;
                        $search = $year . '-' . $month;
                        $shipments = Shipment::where('created_at', 'like', $search .'%');
                    }
                    else if($month == 'last_month') {
                        $month = $date->month - 1;
                        $search = $year . '-' . $month;
                        $shipments = Shipment::where('created_at', 'like', $search .'%');
                    }
                    
                    else if($month == 'last_year') {
                       $shipments = Shipment::whereBetween('created_at', [$lastYearDateS->format('Y-m-d')." 00:00:00", $lastYearDateE->format('Y-m-d')." 23:59:59"]);
                    }
                    else if($month == '2y_back') {
                        $shipments = Shipment::whereBetween('created_at', [$lastTwoYearDateS->format('Y-m-d')." 00:00:00", $lastTwoYearDateE->format('Y-m-d')." 23:59:59"]);
                    }
                    
                    else if($month == 'this_year'){
                    
                        $shipments = Shipment::whereBetween('created_at', [$dateS->format('Y-m-d')." 00:00:00", $dateE->format('Y-m-d')." 23:59:59"]);
                    }else{
                        $shipments = Shipment::all();
                        return PackageResource::collection($shipments);
                    }
                    
                    if($customer_id != 'all'){
                        $shipments->where('sender_id', $customer_id);
                    }
                    $shipments =$shipments->latest()->get();
                $filtered = Helpers::getPaidInvoices($shipments, $status);
                return PackageResource::collection($filtered);

       
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
