<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       
         $startDate = '-40 years'; // 40 years ago
         $endDate = 'now';
         static $brokerId = 1;
         
        return [
            
            'broker_id' => $brokerId++,
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'zip_code' => fake()->postcode(),  
            'description' => fake()->sentence(),
            'build_year' => fake()->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
        ];
    }
}
