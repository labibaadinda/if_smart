<?php

namespace App\Http\Livewire\Departemen;

use Livewire\Component;
use App\Models\mahasiswa;

class DashboardDepartemen extends Component
{
    public function render()
    {
        $sumMahasiswa = mahasiswa::count();
        $mahasiswaAktif = mahasiswa::where('status','aktif')->count();
        $mahasiswas = mahasiswa::all();
        return view('livewire.departemen.dashboard-departemen',compact('sumMahasiswa','mahasiswaAktif','mahasiswas'));
    }
}
