<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswas')->insert([
        [
            'nama' => 'Chika Fujiwara',
            'nim' => '24060120120001',
            'angkatan' => '2020',
            'alamat'       => 'Desa Ngrapah',
            'provinsi_id'  => '16',
            'dosen_id'  => '1',
            'handphone'    => '08123456789',

        ],
        [
            'nama' => 'Azizi Shafa Asadel',
            'nim' => '24060118120001',
            'angkatan' => '2018',
            'alamat'       => 'Desa Ngrapah',
            'provinsi_id'  => '15',
            'dosen_id'  => '1',
            'handphone'    => '08123456789',
        ],
        [
            'nama' => 'Reva Fidela Adel',
            'nim' => '24060119120001',
            'angkatan' => '2019',
            'alamat'       => 'Desa Ngrapah',
            'provinsi_id'  => '14',
            'dosen_id'  => '1',
            'handphone'    => '08123456789',
        ],
        [
            'nama' => 'Gita Sekar Andarini',
            'nim' => '24060120120002',
            'angkatan' => '2020',
            'alamat'       => 'Desa Ngrapah',
            'provinsi_id'  => '13',
            'dosen_id'  => '1',
            'handphone'    => '08123456789',
        ],
        [
            'nama' => 'Adzana Shaliha',
            'nim' => '24060119120002',
            'angkatan' => '2019',
            'alamat'       => 'Desa Ngrapah',
            'provinsi_id'  => '12',
            'dosen_id'  => '1',
            'handphone'    => '08123456789',
        ],
        [
            'nama' => 'Indah Cahya Nabilla',
            'nim' => '24060118120003',
            'angkatan' => '2018',
            'alamat'       => 'Desa Ngrapah',
            'provinsi_id'  => '11',
            'dosen_id'  => '1',
            'handphone'    => '08123456789',
        ],
        ]);
    }
}

