<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pkls')->insert([
            [
                'nim' => '24060119120001',
                'judul' => 'Sistem Informasi Berbasis Website',
                'progres' => '1',
                'stat_pkl' => '1',
                'tanggal_mulai' => '1',
            ],
            [
                'nim' => '24060119120001',
                'judul' => 'Sistem Informasi Berbasis Website',
                'progres' => '2',
                'stat_pkl' => '1',
                'tanggal_mulai' => '1',   
            ],
            ]);
        }
    }

