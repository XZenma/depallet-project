<?php

namespace Database\Factories;

use App\Models\Stall;
use App\Models\StallAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Stall>
 */
class StallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'owner_name' => $this->faker->name(),
            'is_open' => $this->faker->boolean(),
        ];
    }
}
