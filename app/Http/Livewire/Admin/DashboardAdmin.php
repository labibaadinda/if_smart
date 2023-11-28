<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Dosen;
use Livewire\Component;
use App\Models\mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardAdmin extends Component
{
    public function render()
    {
        $user = User::find(Auth::user()->id);
        $sumMahasiswa = mahasiswa::count();
        $mahasiswaAktif = mahasiswa::where('status','aktif')->count();
        $mahasiswas = mahasiswa::all();
        return view('livewire.admin.dashboard-admin',compact('sumMahasiswa','mahasiswaAktif','mahasiswas','user'));
    }

    public function listmahasiswa()
    {
        $user = User::find(Auth::user()->id);
        $sumMahasiswa = mahasiswa::count();
        $mahasiswaaktifs = mahasiswa::where('status','aktif')->get();
        $mahasiswas = mahasiswa::all();
        return view('livewire.admin.listmahasiswa',compact('sumMahasiswa','mahasiswaaktifs','mahasiswas','user'));
    }

    public function listAktif()
    {
        $user = User::find(Auth::user()->id);
        $sumMahasiswa = mahasiswa::count();
        $mahasiswaaktifs = mahasiswa::with('dosen')->where('status','aktif')->get();
        $mahasiswas = mahasiswa::all();
        $dosens = dosen::all();
        return view('livewire.admin.listaktif',compact('sumMahasiswa','mahasiswaaktifs','mahasiswas','user','dosens'));
    }
    
    public function updateInitialData(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // $user = User::findOrFail($id);
        $validatedData = $request->validate([
            'email' => 'required|email',
            'nama' => 'required',
            'nim_nip' => 'required',
        ]);

        $user->update($validatedData);


        // $user = User::where('nim_nip', Auth::user()->nim_nip)->first();
        // $message = 'Data gagal diupdate!';
        // if ($user) {
        //     $user->update(['email' => $validatedData['email']]);
        //     $user->update(['nama' => $validatedData['nama']]);
        //     $user->update(['nim_nip' => $validatedData['nip']]);
        //     $message = 'Data berhasil diupdate!';
        // }

        // Check the result and redirect with appropriate messages
        // if ($user) {
        //     return redirect()->route('admin')->with('success', 'Data berhasil diupdate!');
        // } else {
        //     return redirect()->route('admin')->with('error', 'Data gagal diupdate!');
        // }
        return redirect()->route('admin')->with('success', 'Data berhasil diperbaharui.');
    }

    public function edit(){
        $user = User::find(Auth::user()->id);
    }
}
