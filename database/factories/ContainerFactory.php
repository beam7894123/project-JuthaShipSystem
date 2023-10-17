<?php

namespace Database\Factories;

use App\Models\Journey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Container>
 */
class ContainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = array('PENDING', 'READY', 'MISSING');
        return [
            'company_name' => fake()->name(),
            'status' => $status[array_rand($status)],
            'journey_id' => Journey::find(rand(1,10))
        ];
    }
}
