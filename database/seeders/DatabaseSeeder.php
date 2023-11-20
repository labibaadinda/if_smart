<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Provinsi;
use App\Models\Kota;
use Database\Seeders\IrsSeeder;
use Database\Seeders\KhsSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\DosenSeeder;
use Database\Seeders\ProvinsiSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\MahasiswaSeeder;

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
    	// $this->call(ProvinsiSeeder::class);
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
        Provinsi::factory(10)->create();
        Kota::factory(40)->create();
    }
}
