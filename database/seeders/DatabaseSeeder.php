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
        User::create([
            // 'name'         => 'Chika Fujiwara',
            'email'        => 'chika@gmail.com',
            'password'     => Hash::make('password'),
            'role'         => 'mahasiswa',
            'nim_nip'      => '2406012012001',
            // 'alamat'       => 'Desa Ngrapah',
            // 'kota'         => 'Semarang',
            // 'provinsi'  => 'Jawa Tengah',
            // 'handphone'    => '08123456789',
        ]);

        Mahasiswa::create([
            'nama' => 'Chika Fujiwara',
            'nim' => '2406012012001',
            'angkatan' => '2018',
            'alamat'       => 'Desa Ngrapah',
            'kota'         => 'Semarang',
            'provinsi_id'  => '1',
            'handphone'    => '08123456789',
        ]);
    	$this->call(UserSeeder::class);
        // User::factory(10)->create();
    }
}
