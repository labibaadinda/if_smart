<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = public_path('/csv/kotas.csv');
        $data = array_map('str_getcsv', file($file));
        foreach ($data as $row) {
            // Menyimpan provinsi
            DB::table('kotas')->insert([
                'provinsi_id' => $row[1], // ID dari kolom pertama
                'nama' => $row[2], // Nama dari kolom kedua
            ]);
        }
        // DB::table('kotas')->insert([
        //     [
        //         'nama' => 'Semarang',
        //         'provinsi_id' => '1'
        //     ],
        //     [
        //         'nama' => 'Batang',
        //         'provinsi_id' => '1'
        //     ],
        //     [
        //         'nama' => 'Purwokerto',
        //         'provinsi_id' => '1'
        //     ],
        //     [
        //         'nama' => '',
        //         'provinsi_id' => '1'
        //     ],
        //     [
        //         'nama' => 'Semarang',
        //         'provinsi_id' => '1'
        //     ],
        //     ]);
        // }
    }
}