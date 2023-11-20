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
        DB::table('kotas')->insert([
            [
                'nama' => 'Semarang',
                'provinsi_id' => '1'
            ],
            [
                'nama' => 'Batang',
                'provinsi_id' => '1'
            ],
            [
                'nama' => 'Purwokerto',
                'provinsi_id' => '1'
            ],
            [
                'nama' => '',
                'provinsi_id' => '1'
            ],
            [
                'nama' => 'Semarang',
                'provinsi_id' => '1'
            ],
            ]);
        }
    }
