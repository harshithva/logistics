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
        if($month == 'this_month')
        {
            $month = $date->month;
        }
        else if($month == 'last_month') {
            $month = $date->month - 1;
        }else if($month == 'last_year') {
            $month = null;
            $year--;
        }else{
            $month = null;
        }
         if ($month && $month < 10) {
                $month = '0' . $month;
            }
        $search = $year . '-' . $month;

       if($temp == 'all'){
            $search = "";
        }

        
        if($customer_id != 'all')
        {

            $shipments = Shipment::where('sender_id', $customer_id)->where('created_at', 'like', $search .'%')->latest()->get();
            $filtered = Helpers::getPaidInvoices($shipments, $status);
            return PackageResource::collection($filtered);
        }else {
            if($month == 'all'){
                $shipments = Shipment::latest()->get();
             
                return PackageResource::collection($shipments);
            }else{
                $shipments = Shipment::where('created_at', 'like', $search .'%')->latest()->get();
                $filtered = Helpers::getPaidInvoices($shipments, $status);
                return PackageResource::collection($filtered);
            }
           
        }

        // if($month == 'all')
        // {
        //     return PackageResource::collection($shipments);
        // }else{
            // $date = Carbon::now();
            // $year = $date->year;
            // if($month == 'this_month')
            // {
            //     $month = $date->month;
            // }
            // else if($month == 'last_month') {
            //     $month = $date->month - 1;
            // }
    
            // if ($month < 10) {
            //     $month = '0' . $month;
            // }
    
            // $search = $year . '-' . $month;
            
            // $filtered = $shipments->where(function ($query) use ($search) {
            //     $query->where('created_at', 'like', $search .'%');
            // });
        
           
     
            
            
            // return PackageResource::collection($shipments);

        // }
       
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
