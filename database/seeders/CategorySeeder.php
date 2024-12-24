<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => fake()->unique()->words(2, true), // Generates a short, unique name
            'description' => fake()->realText(50), // Generates a more realistic description
        ]);
    }
}
