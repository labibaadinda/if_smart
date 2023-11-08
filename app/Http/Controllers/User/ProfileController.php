<?php

namespace App\Http\Controllers\User;

use Hash;
use Exception;

use App\Models\User;

use App\Models\Mahasiswa;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateInitialData(Request $request, $id)
    {
        // 
        $mahasiswa = Mahasiswa::findOrFail($id);
        $validatedData = $request->validate([
            'alamat' => 'required|string|max:255',
            'handphone' => 'required|',
            'kota' => 'required|',
            'provinsi_id' => 'required|',
        ]);

        // $existingData = Mahasiswa::where('n', $validatedData['nama'])
        //                     ->where('penampungan_id', $validatedData['penampungan_id'])
        //                     ->where('id', '!=', $alat->id)
        //                     ->first();

        // if($existingData){
        //     return redirect()->with('error', 'Data yang sama sudah ada di database!');
        // }

        $result = $mahasiswa->update($validatedData);
        
        if($result){
            return redirect()->route('user')->with('success', 'Data berhasil diupdate!');
        }else{
            return redirect()->route('user')->with('error', 'Data gagal diupdate!');
        }
    }

    public function index()
    {   
        $mahasiswas = Mahasiswa::with('dosen')->where('nim', Auth::user()->nim_nip)->get();
        $provinsis = Provinsi::All();
    	return view('user.profile', compact('mahasiswas','provinsis'));
    }

    public function update(Request $request, $id) {
        // Ambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);
        // Validasi input
        $validatedData = $request->validate([
            'password' => 'required|min:6',
        ]);

    
        // Periksa apakah password lama benar
        if (Hash::check($request->old_password, Auth::user()->password)) {
            return redirect()->route('user')->with('error', 'Password lama tidak cocok');
        }

        // Update password
        $result = $user->update($validatedData);
    
        if($result){
            return redirect()->route('user')->with('success', 'Data berhasil diupdate!');
        }else{
            return redirect()->route('user')->with('error', 'Data gagal diupdate!');
        }
    }
}
