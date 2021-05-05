<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween(0, 10000),
            'category_id' => null,
            'unit_id' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function empty()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => '',
                'description' => '',
                'price' => '0,00',
            ];
        });
    }
}
