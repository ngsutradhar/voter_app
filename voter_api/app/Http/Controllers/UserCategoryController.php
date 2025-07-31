<?php

namespace App\Http\Controllers;

use App\Models\userCategory;
use App\Http\Requests\StoreuserCategoryRequest;
use App\Http\Requests\UpdateuserCategoryRequest;

class UserCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreuserCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreuserCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userCategory  $userCategory
     * @return \Illuminate\Http\Response
     */
    public function show(userCategory $userCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userCategory  $userCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(userCategory $userCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateuserCategoryRequest  $request
     * @param  \App\Models\userCategory  $userCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateuserCategoryRequest $request, userCategory $userCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userCategory  $userCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(userCategory $userCategory)
    {
        //
    }
}
