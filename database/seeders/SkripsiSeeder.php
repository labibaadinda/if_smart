<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkripsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skripsis')->insert([
            [
                'nim' => '24060119120001',
                'judul' => 'Sistem Informasi Berbasis Website',
                'progres' => '1',
                'stat_skripsi' => 'Progress',
            ],
            [
                'nim' => '24060119120001',
                'judul' => 'Sistem Informasi Berbasis Website',
                'progres' => '2',
                'stat_pkl' => 'Progress',
            ],
            ]);
    }
}
