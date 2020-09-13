<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use App\Http\Resources\Expense as ExpenseResource;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::latest()->get();
        return ExpenseResource::collection($expenses);
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
        $this->validate($request,[
            'name'=>'required|min:1|max:255',
            'category_id'=>'required|integer|max:255',
            'note'=>'nullable|max:255',
            'date'=>'required',
            'amount'=>'required|numeric',
        ]);
        
       $expense = new Expense;
       $expense->name = $request->name;
       $expense->note = $request->note;
       $expense->category_id = $request->category_id;
       $expense->date = Carbon::createFromFormat('d-m-Y',$request->date)->format('Y-m-d');
       $expense->amount = $request->amount;
       $expense->save();

       return new ExpenseResource($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {  $this->validate($request,[
        'name'=>'required|min:1|max:255',
        'category_id'=>'required|integer|max:255',
        'note'=>'nullable|max:255',
        'date'=>'required',
        'amount'=>'required|numeric',
    ]);

 
    $expense->name = $request->name;
    $expense->note = $request->note;
    $expense->category_id = $request->category_id;
    $expense->date = Carbon::createFromFormat('d-m-Y',$request->date)->format('Y-m-d');
    $expense->amount = $request->amount;
    $expense->save();
    return new ExpenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json(null, 204); 
    }
}
