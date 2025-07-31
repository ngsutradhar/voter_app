<?php

namespace App\Http\Controllers;

use App\Models\WorkType;
use App\Http\Requests\StoreWorkTypeRequest;
use App\Http\Requests\UpdateWorkTypeRequest;

class WorkTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreWorkTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkType  $workType
     * @return \Illuminate\Http\Response
     */
    public function show(WorkType $workType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkType  $workType
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkType $workType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkTypeRequest  $request
     * @param  \App\Models\WorkType  $workType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkTypeRequest $request, WorkType $workType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkType  $workType
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkType $workType)
    {
        //
    }
}
