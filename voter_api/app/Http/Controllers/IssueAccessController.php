<?php

namespace App\Http\Controllers;

use App\Models\issueAccess;
use App\Http\Requests\StoreissueAccessRequest;
use App\Http\Requests\UpdateissueAccessRequest;

class IssueAccessController extends Controller
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
     * @param  \App\Http\Requests\StoreissueAccessRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreissueAccessRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\issueAccess  $issueAccess
     * @return \Illuminate\Http\Response
     */
    public function show(issueAccess $issueAccess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\issueAccess  $issueAccess
     * @return \Illuminate\Http\Response
     */
    public function edit(issueAccess $issueAccess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateissueAccessRequest  $request
     * @param  \App\Models\issueAccess  $issueAccess
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateissueAccessRequest $request, issueAccess $issueAccess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\issueAccess  $issueAccess
     * @return \Illuminate\Http\Response
     */
    public function destroy(issueAccess $issueAccess)
    {
        //
    }
}
