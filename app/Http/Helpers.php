<?php
use Carbon\Carbon;

 class Helpers {

    
    public static function getThisMonth($class)
    {
      $date = Carbon::now();
        $year = $date->year;
        $month = $date->month;

        if ($month < 10) {
            $month = '0' . $month;
        }

        $search = $year . '-' . $month;

        $data = $class::where('created_at', 'like', $search .'%')->latest()->get();

        return $data;
    }

    public static function getLastMonth($class)
    {
      $date = Carbon::now();
      $year = $date->year;
      $month = $date->month - 1;

      if ($month < 10) {
          $month = '0' . $month;
      }

      $search = $year . '-' . $month;

        $data = $class::where('created_at', 'like', $search .'%')->latest()->get();

        return $data;
    }


    public static function getPaidInvoices($shipments, $type)
    {

      $FilteredInvoices = [];
      foreach($shipments as $item)
      {
       $item->total_paid = $item->payment->sum('amount');
       $item->shipment_status =  $item->status;

       switch($type) {
        //  paid invoices
         case 'paid':{
     
          if($item->total_paid >=  $item->charge_total)
          {
            array_push($FilteredInvoices,$item);
          }
        
         }
        break;
            //  pending invoices
        case 'pending':{
          if($item->total_paid <=0)
          {
            array_push($FilteredInvoices,$item);
          }  
        
         }
        break;

         //  partial invoices
        case 'partial': {
          if($item->total_paid > 0) 
          {
            array_push($FilteredInvoices,$item);
          }
        }
      break;
         default:{
      
            array_push($FilteredInvoices,$item);
     
         }
        break;
       }
      
      }

        return $FilteredInvoices;
    }


 }
