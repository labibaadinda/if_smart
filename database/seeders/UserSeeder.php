<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
                'nim_nip'       => '1',
            ],
            [
                'email'     => 'ayane@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
                'nim_nip'       => '2',
            ],
            [
                'email'     => 'depart@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'departemen',
                'nim_nip'       => '23242341424',
            ],
            // [
            //     'name'         => 'Chika Fujiwara',
            //     'email'        => 'chika@gmail.com',
            //     'password'     => Hash::make('password'),
            //     'role'         => 'mahasiswa',
            //     'nim_nip'      => '3',
            //     // 'alamat'       => 'Desa Ngrapah',
            //     // 'kota'         => 'Semarang',
            //     // 'provinsi'  => 'Jawa Tengah',
            //     // 'handphone'    => '08123456789',
            // ],
            [
            
                // 'name'         => 'Chika Fujiwara',
                'email'        => 'chika@gmail.com',
                'password'     => Hash::make('password'),
                'role'         => 'mahasiswa',
                'nim_nip'      => '24060120120001',
                // 'alamat'       => 'Desa Ngrapah',
                // 'kota'         => 'Semarang',
                // 'provinsi'  => 'Jawa Tengah',
                // 'handphone'    => '08123456789',
            ],
            [
            
                // 'name'         => 'Chika Fujiwara',
                'email'        => 'dosen@gmail.com',
                'password'     => Hash::make('password'),
                'role'         => 'dosen',
                'nim_nip'      => '00123456789',
                // 'alamat'       => 'Desa Ngrapah',
                // 'kota'         => 'Semarang',
                // 'provinsi'  => 'Jawa Tengah',
                // 'handphone'    => '08123456789',
            ],
            [
                'email'        => 'zee@gmail.com',
                'password'     => Hash::make('password'),
                'role'         => 'mahasiswa',
                'nim_nip'      => '24060118120001',
            ],
        
            [
                'email'        => 'adel@gmail.com',
                'password'     => Hash::make('password'),
                'role'         => 'mahasiswa',
                'nim_nip'      => '24060119120001',
            ],
            [
                    'email'        => 'gita@gmail.com',
                    'password'     => Hash::make('password'),
                    'role'         => 'mahasiswa',
                    'nim_nip'      => '24060120120002',
            ],
            [
                    'email'        => 'freya@gmail.com',
                    'password'     => Hash::make('password'),
                    'role'         => 'mahasiswa',
                    'nim_nip'      => '24060118120002',
            ],
            [
                    'email'        => 'ashel@gmail.com',
                    'password'     => Hash::make('password'),
                    'role'         => 'mahasiswa',
                    'nim_nip'      => '24060119120002',
            ],
            [
                    'email'        => 'indah@gmail.com',
                    'password'     => Hash::make('password'),
                    'role'         => 'mahasiswa',
                    'nim_nip'      => '24060118120003',

            ],
        ]);
    }
}
