<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\pkl;
use App\Models\User;

use App\Models\dosen;
use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DepartemenController extends Controller
{

    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        $countby = Mahasiswa::get()->countBy('angkatan');
        $thnmax = Mahasiswa::get('angkatan')->max();
        $thnmin = Mahasiswa::get('angkatan')->min();
        $pkls = Pkl::get();
        $angkatan = '2019';
        $pkl = Pkl::whereHas('mahasiswa','');
        // $colspanThn = ((int)$thnmax-(int)$thnmin)*2;
        return view('departemen.index',compact('mahasiswas','countby','thnmax','thnmin','pkls','pkl'));
    }
    public function profile()
    {
        return view('departemen.profile');
    }

    public function updateFoto(Request $request, $id)
    {
        $user = User::findOrFail($id);

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
            $user->update(['foto' => $pdfFileName]);

            return redirect()->route('profiledept')->with('success', 'Foto berhasil diperbaharui.');
        } else {
            // Handle kasus tanpa file (opsional)
            // Jika tidak ada 'foto' yang diunggah, 'foto' tidak akan diubah
            // $mahasiswa->update($validatedData);

            return redirect()->route('user')->with('error', 'Data gagal diupdate.');
        }
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

        return redirect()->route('profiledept')->with('success', 'Password berhasil diperbaharui.');
    }
}
