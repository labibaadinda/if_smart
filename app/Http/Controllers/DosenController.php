<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoredosenRequest;
use App\Http\Requests\UpdatedosenRequest;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Irs;
use App\Models\Khs;
use App\Models\Pkl;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosens = Dosen::with('mahasiswa')->where('nip', Auth::user()->nim_nip)->get();
		$mahasiswas = Mahasiswa::All();
		return view('dosen.index', compact('mahasiswas','dosens'));
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
     * @param  \App\Http\Requests\StoredosenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredosenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedosenRequest  $request
     * @param  \App\Models\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedosenRequest $request, dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(dosen $dosen)
    {
        //
    }
}
