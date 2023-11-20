<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provinsi_id'=>mt_rand(1,10),
            'nama'=>$this->faker->unique()->city(),   
        ];
    }
}
