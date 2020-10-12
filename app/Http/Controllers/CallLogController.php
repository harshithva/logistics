<?php

namespace App\Http\Controllers;

use App\CallLog;
use Illuminate\Http\Request;
use App\Http\Resources\CallLog as CallLogResource;

class CallLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $callLogs = CallLog::all();
        return CallLogResource::collection($callLogs);
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
       
        $request->validate([
            "customer_id" => "required|max:255|integer",
            "duration" => "required|max:255",
        ]);
        $callLog = new CallLog;
        $callLog->customer_id = $request->customer_id;
        $callLog->duration = $request->duration;
        $callLog->feedback = $request->feedback;
        $callLog->save();

        return new CallLogResource($callLog);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CallLog  $callLog
     * @return \Illuminate\Http\Response
     */
    public function show(CallLog $callLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CallLog  $callLog
     * @return \Illuminate\Http\Response
     */
    public function edit(CallLog $callLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CallLog  $callLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CallLog $callLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CallLog  $callLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(CallLog $callLog)
    {
        $callLog->delete();
        return response()->json(null,204);
    }
}
