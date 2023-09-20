<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryFactory extends Factory
{
    use HasFactory;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'status' => $this->faker->randomElement([0, 1]),
            'slug' => $this->faker->unique()->name(),
        ];
    }
}
