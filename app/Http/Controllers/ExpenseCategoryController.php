<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Resources\ExpenseCategory as ExpenseCategoryResource;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ExpenseCategory::all();
        return ExpenseCategoryResource::collection($categories);
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
            'name'=>'required|unique:expense_categories|min:1|max:255',
            'description'=>'nullable|max:1500',

        ]);

        $category = new ExpenseCategory;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return new ExpenseCategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $this->validate($request,[
            'name'=>"required|unique:expense_categories,name,$expenseCategory->id",
            'description'=>'nullable|max:1500',
        ]);
        $expenseCategory->name = $request->name;
        $expenseCategory->description = $request->description;
        $expenseCategory->save();
        return new ExpenseCategoryResource($expenseCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $expenseCategory->delete();
        return response()->json(null, 204);
    }
}
