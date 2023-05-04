<?php

namespace Database\Factories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'major_id' => Major::factory()->create()->id,
            'phone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->email(),
            'address' => $this->faker->address(),
        ];
    }
}
