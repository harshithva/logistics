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
        // pending and partial
        // case 'pandp': {
        //   if($item->total_paid > 0 && $item->total_paid < $item->charge_total || !($item->charge_total <= $item->total_paid)) 
        //   {
        //     array_push($FilteredInvoices,$item);
        //   }
        // }
      // break;
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
        else if (+$total_paid <= 0) 
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

    public static function send_whatsapp_update($phone, $docket_no, $status)
    {
     $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://live-server-5799.wati.io/api/v1/sendTemplateMessage?whatsappNumber=91'.$phone);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"template_name\":\"shipment_update\",\"broadcast_name\":\"gurukal_crm\",\"parameters\":[{\"name\":\"docket_no\",\"value\":\"$docket_no\"},{\"name\":\"status\",\"value\":\"$status\"}]}");

    $headers = array();
    $headers[] = 'Accept: */*';
    $headers[] = 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIwOWRkODVkNy02OWI1LTQyYjYtODJhMC1kMTRjMDg0YzI1MmYiLCJ1bmlxdWVfbmFtZSI6IndhdGlAZ3VydWthbC5pbiIsIm5hbWVpZCI6IndhdGlAZ3VydWthbC5pbiIsImVtYWlsIjoid2F0aUBndXJ1a2FsLmluIiwiYXV0aF90aW1lIjoiMTEvMDEvMjAyMSAwNTo0OTozNiIsImRiX25hbWUiOiI1Nzk5IiwiaHR0cDovL3NjaGVtYXMubWljcm9zb2Z0LmNvbS93cy8yMDA4LzA2L2lkZW50aXR5L2NsYWltcy9yb2xlIjoiQURNSU5JU1RSQVRPUiIsImV4cCI6MjUzNDAyMzAwODAwLCJpc3MiOiJDbGFyZV9BSSIsImF1ZCI6IkNsYXJlX0FJIn0.-oYkqhfGL69NL0eqA4B6VlLaCcYBvAkDEzu6h8x-N_E';
    $headers[] = 'Content-Type: application/json-patch+json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    }

 }
