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
                'email'     => 'kotone@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'mahasiswa',
                'nim_nip'       => '4',

            ],
        ]);
    }
}
