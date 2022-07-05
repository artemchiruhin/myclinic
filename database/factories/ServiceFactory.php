<?php

namespace Database\Factories;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = ServiceCategory::inRandomOrder()->limit(1)->first();
        return [
            'name' => 'Услуга ' . $this->faker->unique()->word(),
            'description' => $this->faker->realText(50),
            'price' => rand(199, 1999),
            'service_category_id' => $category->id,
            'image' => $this->faker->image('public/storage/services',400,300, null, false)
        ];
    }
}
