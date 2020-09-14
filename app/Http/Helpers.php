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


 }
