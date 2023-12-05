<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    private $changesMade = false;

    public function model(array $row)
    {
        // Find Mahasiswa record based on the nim
        $mahasiswa = Mahasiswa::where('nim', $row['nim'])->first();

        if ($mahasiswa) {
            // Check if any changes are made
            $changes = [
                'nama' => $row['nama'],
                'dosen_id' => $row['dosen_id'],
                'status' => $row['status'],
                'angkatan' => $row['angkatan'],
                // Add other fields as needed
            ];

            if ($this->hasChanges($mahasiswa, $changes)) {
                // Changes found, update the fields
                $mahasiswa->update($changes);
                $this->changesMade = true;
            }
        } else {
            // No existing record found, create a new Mahasiswa record
            Mahasiswa::create([
                'nim' => $row['nim'],
                'nama' => $row['nama'],
                'dosen_id' => $row['dosen_id'],
                'status' => $row['status'],
                'angkatan' => $row['angkatan'],
                // Add other fields as needed
            ]);

            $this->changesMade = true;
        }

        // Create or update User record based on nim_nip
        User::updateOrCreate(
            ['nim_nip' => $row['nim']],
            [
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                // Add other fields as needed
            ]
        );

        return $mahasiswa;
    }

    public function changesMade()
    {
        return $this->changesMade;
    }

    private function hasChanges($model, $changes)
{
    foreach ($changes as $field => $value) {
        if ($model->{$field} != $value) {
            return true;
        }
    }

    return false;
}
}
