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
       $item->total_paid = $item->payment->sum('amount') + $item->charge_advance_paid;
       $item->shipment_status =  $item->status;

       //payment status
       $item->payment_status = self::getPaymentStatus($item->charge_total, $item->total_paid);
       $item->sender_name = $item->sender->name;

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
          if(!($item->charge_total <= $item->total_paid))
          {
            array_push($FilteredInvoices,$item);
          }  
        
         }
        break;

         //  partial invoices
        case 'partial': {
          if($item->total_paid > 0 && $item->total_paid < $item->charge_total) 
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

    public static function getPaymentStatus($total, $total_paid)
    {
     
        if($total_paid >= $total) 
          return 'PAID';
        else if (+$total <= 0) 
          return 'PENDING';
        else
          return 'PARTIAL';
        
    }



    public static function getShipmentBalanceAmount($shipment)
    {
      $total_paid = $shipment->payment->sum('amount');
      $balance_amount = $shipment->charge_total - $total_paid -  $shipment->charge_advance_paid - $shipment->tds_amount;
      return $balance_amount;
    }

 }
