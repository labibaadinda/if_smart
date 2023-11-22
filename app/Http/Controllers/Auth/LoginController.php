<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function authenticate()
	{
		$credentials = request()->only(['email', 'password']);


		// if (Auth::attempt($credentials)) {
        if (Auth::attempt($credentials) || Auth::attempt(['nim_nip' => $credentials['email'], 'password' => $credentials['password']])) {
			$userRole = auth()->user()->role;

			switch ($userRole) {
				case "admin":
					return redirect()->intended('operator');

					break;
				case "mahasiswa":
					return redirect()->intended('user');

					break;
				case "dosen":
					return redirect()->intended('dosen');

					break;
				case "departemen":
					return redirect()->intended('departemen');

					break;
				default:
					redirect()->to('/');
			}
		}

		return back()->with('error', 'Invalid login crendentials');
	}
}
