<?php

namespace Database\Seeders;

use App\Models\Panel\Category;
use App\Models\Panel\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $category = Category::query()->findOrFail(7);
        for ($i = 1; $i <= 20 ; $i++) {
            $products =   Product::query()->create([
                'title'=> $faker->sentence,
                'is_default' => 1,
                'title_en'=> $faker->sentence,
                'slug'=> $faker->sentence,
                'slug_en'=> $faker->sentence,
                'summary'=> $faker->sentence,
                'summary_en'=> $faker->sentence,
                'content'=> $faker->sentence,
                'content_en'=> $faker->sentence,
                'multi_image'=> $faker->imageUrl = 'https://example.com/images/',
                'multi_image_en'=> $faker->imageUrl = 'https://example.com/images/',
                'video_url' => $faker->imageUrl = 'https://example.com/videos/',
                'video_url_en' => $faker->imageUrl = 'https://example.com/videos/',
                'price' => 12544000,
                'price_en' => 12544000,
                'status_price' => 'disable',
                'user_id' => 1,
            ]);
            Product::chunk(10, function ($products) use ($category) {
                foreach ($products as $product) {

                    $product->categories()->syncWithoutDetaching($category->id);
                }
            });
        }

    }
}
