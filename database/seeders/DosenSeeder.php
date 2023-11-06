<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosens')->insert([
            [
                'nama' => 'Irvan Gunawan, S.Si., M.T.',
                'nip' => '00123456789',
                
            ],
            [
                'nama' => 'Deddy Cahyadi, S.Kom., M.T.',
                'nip' => '00123456789',   
            ],
            ]);
        }
    
}
