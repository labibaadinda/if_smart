<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('khs')->insert([
            [
                'nim' => '24060119120001',
                'semester' => '1',
                'jumlah_sks' => '24',
                'ips' => '3.81',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '2',
                'jumlah_sks' => '21',
                'ips' => '4',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '3',
                'jumlah_sks' => '23',
                'ips' => '3.9',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '4',
                'jumlah_sks' => '21',
                'ips' => '3.93',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '5',
                'jumlah_sks' => '21',
                'ips' => '3.8',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '6',
                'jumlah_sks' => '23',
                'ips' => '3.7',
            ],
            ]);
    }
}
