<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run():void
    {
    	$this->call(UserSeeder::class);
    	$this->call(IrsSeeder::class);
    	$this->call(KhsSeeder::class);
    	$this->call(MahasiswaSeeder::class);
    	$this->call(DosenSeeder::class);
        Mahasiswa::create([
            'nama' => 'Freyana Syifa Jayawardana',
            'nim' => '24060118120002',
            'angkatan' => '2018',
            'alamat'       => 'Desa Ngrapah',
            'provinsi_id'  => '1',
            'dosen_id'  => '1',
            'handphone'    => '08123456789',
        ]);
        // User::factory(10)->create();
    }
}
