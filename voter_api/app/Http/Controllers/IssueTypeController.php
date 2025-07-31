<?php

namespace App\Http\Controllers;

use App\Models\issueType;
use App\Http\Requests\StoreissueTypeRequest;
use App\Http\Requests\UpdateissueTypeRequest;

class IssueTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreissueTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreissueTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\issueType  $issueType
     * @return \Illuminate\Http\Response
     */
    public function show(issueType $issueType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\issueType  $issueType
     * @return \Illuminate\Http\Response
     */
    public function edit(issueType $issueType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateissueTypeRequest  $request
     * @param  \App\Models\issueType  $issueType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateissueTypeRequest $request, issueType $issueType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\issueType  $issueType
     * @return \Illuminate\Http\Response
     */
    public function destroy(issueType $issueType)
    {
        //
    }
}
