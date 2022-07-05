<?php

namespace Database\Factories;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = explode(' ', $this->faker->name());
        $category = ServiceCategory::inRandomOrder()->limit(1)->first();
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'first_name' => $name[1],
            'last_name' => $name[0],
            'patronymic' => $name[2],
            'phone' => (string) rand(80000000000, 89999999999),
            'service_category_id' => $category->id,
            'image' => $this->faker->image('public/storage/employees',400,300),
            'started_at' => date('Y-m-d')
        ];
    }
}
