<?php

namespace App\Http\Controllers;

use App\Models\pkl;
use App\Http\Requests\StorepklRequest;
use App\Http\Requests\UpdatepklRequest;

class PklController extends Controller
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
     * @param  \App\Http\Requests\StorepklRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepklRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pkl  $pkl
     * @return \Illuminate\Http\Response
     */
    public function show(pkl $pkl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pkl  $pkl
     * @return \Illuminate\Http\Response
     */
    public function edit(pkl $pkl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepklRequest  $request
     * @param  \App\Models\pkl  $pkl
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepklRequest $request, pkl $pkl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pkl  $pkl
     * @return \Illuminate\Http\Response
     */
    public function destroy(pkl $pkl)
    {
        //
    }
}
