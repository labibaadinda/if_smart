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
            'nim_nip'      => '24060120120001',
            // 'alamat'       => 'Desa Ngrapah',
            // 'kota'         => 'Semarang',
            // 'provinsi'  => 'Jawa Tengah',
            // 'handphone'    => '08123456789',
        ]);

        User::create([
            'email'        => 'zee@gmail.com',
            'password'     => Hash::make('password'),
            'role'         => 'mahasiswa',
            'nim_nip'      => '24060118120001',
        ]);
        User::create([
            'email'        => 'adel@gmail.com',
            'password'     => Hash::make('password'),
            'role'         => 'mahasiswa',
            'nim_nip'      => '24060119120001',
        ]);
        User::create([
            'email'        => 'gita@gmail.com',
            'password'     => Hash::make('password'),
            'role'         => 'mahasiswa',
            'nim_nip'      => '24060120120002',
        ]);
        User::create([
            'email'        => 'freya@gmail.com',
            'password'     => Hash::make('password'),
            'role'         => 'mahasiswa',
            'nim_nip'      => '24060118120002',
        ]);
        User::create([
            'email'        => 'ashel@gmail.com',
            'password'     => Hash::make('password'),
            'role'         => 'mahasiswa',
            'nim_nip'      => '24060119120002',
        ]);
        User::create([
            'email'        => 'indah@gmail.com',
            'password'     => Hash::make('password'),
            'role'         => 'mahasiswa',
            'nim_nip'      => '24060118120003',
        ]);
        
        
        Mahasiswa::create([
            'nama' => 'Chika Fujiwara',
            'nim' => '24060120120001',
            'angkatan' => '2020',
            'alamat'       => 'Desa Ngrapah',
            'kota'         => 'Semarang',
            'provinsi_id'  => '1',
            'handphone'    => '08123456789',
        ]);

        Mahasiswa::create([
            'nama' => 'Azizi Shafa Asadel',
            'nim' => '24060118120001',
            'angkatan' => '2018',
            'alamat'       => 'Desa Ngrapah',
            'kota'         => 'Semarang',
            'provinsi_id'  => '1',
            'handphone'    => '08123456789',
        ]);
        Mahasiswa::create([
            'nama' => 'Reva Fidela Adel',
            'nim' => '24060119120001',
            'angkatan' => '2019',
            'alamat'       => 'Desa Ngrapah',
            'kota'         => 'Semarang',
            'provinsi_id'  => '1',
            'handphone'    => '08123456789',
        ]);
        Mahasiswa::create([
            'nama' => 'Gita Sekar Andarini',
            'nim' => '24060120120002',
            'angkatan' => '2020',
            'alamat'       => 'Desa Ngrapah',
            'kota'         => 'Semarang',
            'provinsi_id'  => '1',
            'handphone'    => '08123456789',
        ]);
        Mahasiswa::create([
            'nama' => 'Freyana Syifa Jayawardana',
            'nim' => '24060118120002',
            'angkatan' => '2018',
            'alamat'       => 'Desa Ngrapah',
            'kota'         => 'Semarang',
            'provinsi_id'  => '1',
            'handphone'    => '08123456789',
        ]);
        Mahasiswa::create([
            'nama' => 'Adzana Shaliha',
            'nim' => '24060119120002',
            'angkatan' => '2019',
            'alamat'       => 'Desa Ngrapah',
            'kota'         => 'Semarang',
            'provinsi_id'  => '1',
            'handphone'    => '08123456789',
        ]);
        Mahasiswa::create([
            'nama' => 'Indah Cahya Nabilla',
            'nim' => '24060118120003',
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
