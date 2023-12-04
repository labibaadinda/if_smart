<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Map the headers to the corresponding database fields
        $mahasiswa = new Mahasiswa([
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'dosen_id' => $row['dosen_id'],
            'status' => $row['status'],
            'angkatan' => $row['angkatan'],
            // Add other fields as needed
        ]);

        // Save the Mahasiswa record
        $mahasiswa->save();

        $user = new User([
            'nim_nip' => $row['nim'],
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            // Add other fields as needed
        ]);

        // Save the User record
        $user->save();

        return $mahasiswa;
    }
}
