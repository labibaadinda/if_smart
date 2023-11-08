<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\mahasiswa;

class DashboardAdmin extends Component
{
    public function render()
    {
        $sumMahasiswa = mahasiswa::count();
        $mahasiswaAktif = mahasiswa::where('status','aktif')->count();
        $mahasiswas = mahasiswa::all();
        return view('livewire.admin.dashboard-admin',compact('sumMahasiswa','mahasiswaAktif','mahasiswas'));
    }
}
