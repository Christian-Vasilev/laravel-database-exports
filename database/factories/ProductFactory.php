<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Related model to Factory
     *
     * @var string
     *
     * @type Product
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $description = fake()->unique()->text(300);
        $date = now()->subDays(fake()->randomNumber(3));

        return [
            'product_name' => fake()->unique()->name(),
            'product_description' => $description,
            'product_short_description' => Str::limit($description, 50, '...'),
            'price' => fake()->numberBetween(1000, 50000),
            'currency' => 'EUR',
            'product_type' => fake()->randomElement(['account', 'ingame_goods', 'physical_goods']),
            'product_image' => fake()->word().'.webp',
            'show_in_store' => fake()->randomElement([0, 1]),
            'position' => fake()->unique()->randomNumber(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
