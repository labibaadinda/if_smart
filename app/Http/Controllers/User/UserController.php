<?php

namespace App\Http\Controllers\User;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
	{
		$mahasiswas = Mahasiswa::with('dosen')->where('nim', Auth::user()->nim_nip)->get();
		$dosens = Dosen::All();
		return view('user.index', compact('mahasiswas','dosens'));
	}
}
