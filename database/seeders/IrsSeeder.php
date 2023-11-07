<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('irs')->insert([
            [
                'nim' => '24060119120001',
                'semester' => '1',
                'jumlah_sks' => '24',
                'status' => '1',
            ],
            [
                'nim' => '24060119120001',
                'semester' => '2',
                'jumlah_sks' => '21',
                'status' => '1',
                
            ],
            [
                'nim' => '24060119120001',
                'semester' => '3',
                'jumlah_sks' => '23',
                'status' => '1',
               
            ],
            [
                'nim' => '24060119120001',
                'semester' => '4',
                'jumlah_sks' => '21',
                'status' => '1',
                
            ],
            [
                'nim' => '24060119120001',
                'semester' => '5',
                'jumlah_sks' => '21',
                'status' => '1',
                
            ],
            [
                'nim' => '24060119120001',
                'semester' => '6',
                'jumlah_sks' => '18',
                'status' => '1',
               
            ],
            [
                'nim' => '24060119120002',
                'semester' => '1',
                'jumlah_sks' => '24',
                'status' => '1',
            ],
            ]);
    }
}
