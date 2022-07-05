<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Feedback;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        Feedback::factory(10)->create();
        $this->call(ServiceCategoriesSeeder::class);
        Employee::factory(10)->create();
        Service::factory(10)->create();
    }
}
