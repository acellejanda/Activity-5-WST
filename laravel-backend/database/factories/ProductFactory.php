<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categories;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    //  /**
    //  * Define the model's default state.
    //  *
    //  * @return array<string, mixed>
    //  */
    // public function definition(): array
    // {
    //     // return [
    //     //     //
    //     // ];
    // }
    public function definition(): array
    {
        return [
            'category_id' => Categories::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 5, 500),
        ];
    }
}
