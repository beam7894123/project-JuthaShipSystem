<?php

namespace Database\Factories;

use App\Models\Journey;
use App\Models\Ship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Journey>
 */
class JourneyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = array('UPCOMING','ONGOING','COMPLETED','CANCELLED');
        return [
            'start_date' => fake()->date(),
            'arrive_date' => fake()->date(),
            'destination' => fake()->city(),
            'status' => $status[array_rand($status)],
            'ship_id' => Ship::find(rand(1,10)),
        ];
    }
}
