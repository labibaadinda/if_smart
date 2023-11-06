<?php

namespace App\Http\Controllers\User;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
	{
		$mahasiswas = Mahasiswa::where('nim', Auth::user()->nim_nip)->get();
		return view('user.index', compact('mahasiswas'));
	}
}
