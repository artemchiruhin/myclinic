<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = explode(' ', $this->faker->name());
        return [
            'first_name' => $name[1],
            'last_name' => $name[0],
            'patronymic' => $name[2],
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '12345',
            'phone' => (string) rand(80000000000, 89999999999),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
