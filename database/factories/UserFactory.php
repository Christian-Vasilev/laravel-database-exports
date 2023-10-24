<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Related model to Factory
     *
     * @var string
     *
     * @type User
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = now()->subDays(fake()->randomNumber(3));

        return [
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'nickname' => fake()->userName(),
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'country' => fake()->country(),
            'dob_day' => (int) fake()->date('d'),
            'dob_month' => (int) fake()->month(),
            'dob_year' => (int) fake()->year(),
            'player_role' => fake()->numberBetween(1, 3),
            'avatar' => fake()->word().'.webp',
            'avatar_type' => fake()->randomElement(['raceAvatar', 'uploadedCharacter']),
            'avatar_gender' => fake()->randomElement(['Male', 'Female']),
            'newsletter_subscribed' => fake()->randomElement([0, 1]),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
