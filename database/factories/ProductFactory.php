<?php

namespace Database\Factories;

use App\Models\Productline;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productline = Productline::inRandomOrder()->first();
        return [

            'productCode'=>$this->faker->unique()->lexify('??????'),
            'productName'=>$this->faker->word,
            'productLine'=>$productline,
            'productScale'=>$this->faker->word,
            'productVendor'=>$this->faker->company,
            'productDescription'=>$this->faker->sentence,
            'quantityInStock'=>$this->faker->numberBetween(1, 1000),
            'buyPrice'=>$this->faker->randomFloat(2, 1, 1000),
            'MSRP'=>$this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
