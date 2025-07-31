<?php

namespace App\Http\Controllers;

use App\Models\EmployeeCategory;
use App\Http\Requests\StoreEmployeeCategoryRequest;
use App\Http\Requests\UpdateEmployeeCategoryRequest;

class EmployeeCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreEmployeeCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeCategory $employeeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeCategory $employeeCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeCategoryRequest  $request
     * @param  \App\Models\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeCategoryRequest $request, EmployeeCategory $employeeCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeCategory $employeeCategory)
    {
        //
    }
}
