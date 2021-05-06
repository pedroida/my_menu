<?php

namespace Database\Factories;

use App\Enums\PromotionTypeEnum;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
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
        $date = now();
        return [
            'name' => $this->faker->name(),
            'type' => PromotionTypeEnum::VALUE_TO_DISCOUNT,
            'valid_from' => $date,
            'valid_until' => $date->addDays(7),
            'value' => 5,
            'products' => []
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
                'type' => PromotionTypeEnum::VALUE_TO_DISCOUNT,
                'valid_from' => null,
                'valid_until' => null,
                'value' => 0,
            ];
        });
    }
}
