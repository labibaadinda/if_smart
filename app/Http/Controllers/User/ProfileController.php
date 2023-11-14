<?php

namespace App\Http\Controllers\User;


use Exception;

use App\Models\User;

use App\Models\Provinsi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'required|email',    
        ]);

        // $existingData = Mahasiswa::where('n', $validatedData['nama'])
        //                     ->where('penampungan_id', $validatedData['penampungan_id'])
        //                     ->where('id', '!=', $alat->id)
        //                     ->first();

        // if($existingData){
        //     return redirect()->with('error', 'Data yang sama sudah ada di database!');
        // }

        $mahasiswa->update($validatedData);
        
        
        $user = User::where('nim_nip', Auth::user()->nim_nip)->first();

        if ($user) {
            $user->update(['email' => $validatedData['email']]);
        }

        // Check the result and redirect with appropriate messages
        if ($mahasiswa && $user) {
            return redirect()->route('user')->with('success', 'Data berhasil diupdate!');
        } else {
            return redirect()->route('user')->with('error', 'Data gagal diupdate!');
        }
    }

    public function updateFoto(Request $request, $id)
    { 
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Validasi input jika diperlukan
        $request->validate([
            'foto' => 'nullable|mimes:jpg,png|max:2048',
        ]);
    
        if ($request->hasFile('foto')) {
            $pdfFile = $request->file('foto');
            $pdfFileName = time() . '.' . $pdfFile->getClientOriginalExtension();
    
            // Simpan file ke direktori storage/app/public/foto
            $pdfFile->storeAs('public/foto', $pdfFileName);
    
            // Update data Mahasiswa dengan 'foto' baru
            $mahasiswa->update(['foto' => $pdfFileName]);
    
            return redirect()->route('user')->with('success', 'Foto berhasil diperbaharui.');
        } else {
            // Handle kasus tanpa file (opsional)
            // Jika tidak ada 'foto' yang diunggah, 'foto' tidak akan diubah
            // $mahasiswa->update($validatedData);
    
            return redirect()->route('user')->with('success', 'Data berhasil diupdate.');
        }
    }

    public function index()
    {   
        $mahasiswas = Mahasiswa::with('dosen')->where('nim', Auth::user()->nim_nip)->get();
        $provinsis = Provinsi::All();
    	return view('user.profile', compact('mahasiswas','provinsis'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        // Validasi input jika diperlukan
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);
    
        // Verifikasi password lama
        // if (!Hash::check($request->input('current_password'), $user->password)) {
        //     return redirect()->back()->withErrors(['current_password' => 'Password lama tidak cocok.'])->withInput();
        // }
    
        // Update password
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);
    
        return redirect()->route('profile')->with('success', 'Password berhasil diperbaharui.');
    }
}
