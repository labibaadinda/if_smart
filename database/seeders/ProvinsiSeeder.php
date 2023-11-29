<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menggunakan data dari file CSV, sesuaikan path dan format file dengan kebutuhan Anda
        $file = public_path('/csv/provinsis.csv');
        $data = array_map('str_getcsv', file($file));
        foreach ($data as $row) {
            // Menyimpan provinsi
            DB::table('provinsis')->insert([
                'id' => $row[0], // ID dari kolom pertama
                'nama' => $row[1], // Nama dari kolom kedua
            ]);
        }
        // DB::table('provinsis')->insert([
        //     ['nama' => 'Aceh'],
        //     ['nama' => 'Sumatera Utara'],
        //     ['nama' => 'Sumatera Barat'],
        //     ['nama' => 'Riau'],
        //     ['nama' => 'Jambi'],
        //     ['nama' => 'Sumatera Selatan'],
        //     ['nama' => 'Bengkulu'],
        //     ['nama' => 'Lampung'],
        //     ['nama' => 'Kepulauan Bangka Belitung'],
        //     ['nama' => 'Kepulauan Riau'],
        //     ['nama' => 'DKI Jakarta'],
        //     ['nama' => 'Jawa Barat'],
        //     ['nama' => 'Jawa Tengah'],
        //     ['nama' => 'DI Yogyakarta'],
        //     ['nama' => 'Jawa Timur'],
        //     ['nama' => 'Banten'],
        //     ['nama' => 'Bali'],
        //     ['nama' => 'Nusa Tenggara Barat'],
        //     ['nama' => 'Nusa Tenggara Timur'],
        //     ['nama' => 'Kalimantan Barat'],
        //     ['nama' => 'Kalimantan Tengah'],
        //     ['nama' => 'Kalimantan Selatan'],
        //     ['nama' => 'Kalimantan Timur'],
        //     ['nama' => 'Kalimantan Utara'],
        //     ['nama' => 'Sulawesi Utara'],
        //     ['nama' => 'Sulawesi Tengah'],
        //     ['nama' => 'Sulawesi Selatan'],
        //     ['nama' => 'Sulawesi Tenggara'],
        //     ['nama' => 'Gorontalo'],
        //     ['nama' => 'Maluku'],
        //     ['nama' => 'Maluku Utara'],
        //     ['nama' => 'Papua Barat'],
        //     ['nama' => 'Papua'],
        //     ]);

    }
}
