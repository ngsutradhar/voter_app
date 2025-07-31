<?php

namespace App\Http\Controllers;

use App\Models\issueResolveStatus;
use App\Http\Requests\StoreissueResolveStatusRequest;
use App\Http\Requests\UpdateissueResolveStatusRequest;

class IssueResolveStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreissueResolveStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreissueResolveStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\issueResolveStatus  $issueResolveStatus
     * @return \Illuminate\Http\Response
     */
    public function show(issueResolveStatus $issueResolveStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\issueResolveStatus  $issueResolveStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(issueResolveStatus $issueResolveStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateissueResolveStatusRequest  $request
     * @param  \App\Models\issueResolveStatus  $issueResolveStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateissueResolveStatusRequest $request, issueResolveStatus $issueResolveStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\issueResolveStatus  $issueResolveStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(issueResolveStatus $issueResolveStatus)
    {
        //
    }
}
