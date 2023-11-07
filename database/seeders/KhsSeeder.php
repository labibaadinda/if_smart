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
                'ips' => '3.81',
                'status' => '1',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '2',
                'ips' => '4',
                'status' => '1',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '3',
                'ips' => '3.9',
                'status' => '1',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '4',
                'ips' => '3.93',
                'status' => '1',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '5',
                'ips' => '3.8',
                'status' => '1',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '6',
                'ips' => '3.7',
                'status' => '1',
            ],
            [
                'nim' => '24060119120002',
                'semester' => '1',
                'ips' => '4',
                'status' => '1',
            ],
            ]);
    }
}
