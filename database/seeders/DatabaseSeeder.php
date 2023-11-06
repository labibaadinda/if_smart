<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run():void
    {
    	$this->call(UserSeeder::class);
    	$this->call(MahasiswaSeeder::class);
    	$this->call(DosenSeeder::class);
        // User::factory(10)->create();
    }
}
