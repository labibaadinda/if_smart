<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Hash;

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
                'name'      => 'Rahmat Hidayatullah',
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
                'nim_nip'       => '1',
            ],
            [
                'name'      => 'Ayane',
                'email'     => 'ayane@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'admin',
                'nim_nip'       => '2',
            ],
            [
                'name'      => 'Chika Fujiwara',
                'email'     => 'chika@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'mahasiswa',
                'nim_nip'       => '3',
            ],
            [
                'name'      => 'Kotone',
                'email'     => 'kotone@gmail.com',
                'password'  => Hash::make('password'),
                'role'      => 'mahasiswa',
                'nim_nip'       => '4',

            ],
        ]);
    }
}
