<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seller_name' => $this->faker->name,
            'seller_email'=> $this->faker->email,
            'model'=>$this->faker->randomElement(['fusion','A1', 'M3']),
            'year'=> $this->faker->year,
            'make'=>$this->faker->randomElement(['Ford','Audi', 'BMW'])
        ];
    }
}
