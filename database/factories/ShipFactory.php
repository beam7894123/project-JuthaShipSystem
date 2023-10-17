<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ship>
 */
class ShipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = array('DOWN','READY');
        return [
            'model' => fake()->domainName(),
            'fuel' => fake()->numberBetween(0,100),
            'engine_status' => $status[array_rand($status)],
            'container_capcity' => fake()->numberBetween(0,50),
            'crew_capacity' => fake()->numberBetween(0,50)
        ];
    }
}
