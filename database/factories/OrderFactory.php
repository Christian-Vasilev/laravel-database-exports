<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Related model to Factory
     *
     * @var string
     * @type Order
     *
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = now()->subDays(fake()->randomNumber(3));
        $paymentType = fake()->randomElement([null, 'cash', 'card']);
        $product = Product::factory()->create();

        return [
            'user_id' => fake()->numberBetween(1, 150000),
            'product_id' => fn () => $product->id,
            'payment_type' => $paymentType,
            'payment_id' => in_array($paymentType, [null, 'cash']) ? null : fake()->randomNumber(3),
            'total_amount' => $product->price,
            'status' => fake()->randomElement(['pending', 'confirmed', 'declined']),
            'currency' => fake()->currencyCode(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
