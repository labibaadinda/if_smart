<?php

namespace App\Http\Controllers;

use App\Models\khs;
use App\Http\Requests\StorekhsRequest;
use App\Http\Requests\UpdatekhsRequest;

class KhsController extends Controller
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
     * @param  \App\Http\Requests\StorekhsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorekhsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\khs  $khs
     * @return \Illuminate\Http\Response
     */
    public function show(khs $khs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\khs  $khs
     * @return \Illuminate\Http\Response
     */
    public function edit(khs $khs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekhsRequest  $request
     * @param  \App\Models\khs  $khs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekhsRequest $request, khs $khs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\khs  $khs
     * @return \Illuminate\Http\Response
     */
    public function destroy(khs $khs)
    {
        //
    }
}
