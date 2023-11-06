<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                'nim' => 'Irvan Gunawan, S.Si., M.T.',
                'judul' => '00123456789',
                'progres' => '1',
                'stat_pkl' => '1',
                'tanggal_mulai' => '1',
            ],
            [
                'nama' => 'Deddy Cahyadi, S.Kom., M.T.',
                'nip' => '00123456789',   
            ],
            ]);
        }
    }
}
