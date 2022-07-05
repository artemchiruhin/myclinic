<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $service = Service::inRandomOrder()->limit(1)->first();
        return [
            'service_id' => $service->id,
            'name' => $this->faker->firstName,
            'message' => $this->faker->realText(50),
            'rate' => rand(1, 5),
            'approved' => rand(0, 1)
        ];
    }
}
