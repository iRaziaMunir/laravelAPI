<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Productline>
 */
class ProductlineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'productLine'=>$this->faker->unique()->word,
            'textDescription'=>$this->faker->sentence(10),
            'htmlDescription'=>$this->faker->randomHtml(),
            'image'=>$this->faker->imageUrl(640, 480, 'products', true, 'Faker'),
        ];
    }
}
