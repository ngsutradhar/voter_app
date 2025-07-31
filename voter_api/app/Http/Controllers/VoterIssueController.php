<?php

namespace App\Http\Controllers;

use App\Models\voterIssue;
use App\Http\Requests\StorevoterIssueRequest;
use App\Http\Requests\UpdatevoterIssueRequest;

class VoterIssueController extends Controller
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
     * @param  \App\Http\Requests\StorevoterIssueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorevoterIssueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\voterIssue  $voterIssue
     * @return \Illuminate\Http\Response
     */
    public function show(voterIssue $voterIssue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\voterIssue  $voterIssue
     * @return \Illuminate\Http\Response
     */
    public function edit(voterIssue $voterIssue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatevoterIssueRequest  $request
     * @param  \App\Models\voterIssue  $voterIssue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatevoterIssueRequest $request, voterIssue $voterIssue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\voterIssue  $voterIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy(voterIssue $voterIssue)
    {
        //
    }
}
