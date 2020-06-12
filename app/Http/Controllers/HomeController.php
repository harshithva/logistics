<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role == 'admin')
        {
            return view('admin.master');
        }
       
        else{
            return view('staff.master');
        }
    }
    public function staff()
    {
        return view('staff.master');
    }
    public function customer()
    {
        return view('customer.master');
    }
}
