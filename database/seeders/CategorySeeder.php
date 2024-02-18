<?php

namespace Database\Seeders;

use App\Models\Panel\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 1000; $i++) {
            Category::query()->create([
                'title' => $faker->sentence,
                'slug' => $faker->sentence,
                'title_en' => $faker->sentence,
                'slug_en' => $faker->sentence,
                'parent_id' => null,
                'user_id' => 1,
            ]);
        }
    }
}
