<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;


use App\Http\Resources\LeadResource;
use App\Http\Resources\LeadCollection;
use App\Http\Requests\LeadStoreRequest;
use App\Http\Requests\LeadUpdateRequest;


class LeadController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leads = Lead::latest()
            ->get();

        return new LeadCollection($leads);
    }

    /**
     * @param \App\Http\Requests\LeadStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeadStoreRequest $request)
    {

        $validated = $request->validated();

        $lead = Lead::create($validated);

        return new LeadResource($lead);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lead $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Lead $lead)
    {
        return new LeadResource($lead);
    }

    /**
     * @param \App\Http\Requests\LeadUpdateRequest $request
     * @param \App\Models\Lead $lead
     * @return \Illuminate\Http\Response
     */
    public function update(LeadUpdateRequest $request, Lead $lead)
    {
        $validated = $request->validated();

        $lead->update($validated);

        return new LeadResource($lead);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Lead $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lead $lead)
    {
        $lead->delete();
        return response()->noContent();
    }
}
