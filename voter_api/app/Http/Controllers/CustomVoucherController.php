<?php

namespace App\Http\Controllers;

use App\Models\CustomVoucher;
use App\Http\Requests\StoreCustomVoucherRequest;
use App\Http\Requests\UpdateCustomVoucherRequest;

class CustomVoucherController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomVoucherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomVoucher  $customVoucher
     * @return \Illuminate\Http\Response
     */
    public function show(CustomVoucher $customVoucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomVoucher  $customVoucher
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomVoucher $customVoucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomVoucherRequest  $request
     * @param  \App\Models\CustomVoucher  $customVoucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomVoucherRequest $request, CustomVoucher $customVoucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomVoucher  $customVoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomVoucher $customVoucher)
    {
        //
    }
}
