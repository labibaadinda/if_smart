<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\mahasiswa;
use Illuminate\Support\Facades\Auth;

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

    public function edit(){
        $user = User::find(Auth::user()->id);
    }
}
