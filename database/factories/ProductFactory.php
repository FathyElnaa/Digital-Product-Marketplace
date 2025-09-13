<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->words(3, true);
        return [
            'title' => ucfirst($title),
            'slug' => Str::slug($title . '-' . Str::random(5)),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'file_path' => 'products/' . $this->faker->uuid . '.pdf',
            'thumbnail' => $this->faker->imageUrl(640, 480, 'products', true, 'Faker'),
            'category_id' => Category::get()->random()->id,
        ];
    }
}
