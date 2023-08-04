<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        require('image.php');

        $category_title = $this->faker->text(rand(15,40));

        return [
            'category_title' => $category_title,
            'slug' => str_slug($category_title),
            'category_text' => rtrim($this->faker->sentence(rand(2,5)),'.'),
            'category_img' => $product_imgs[rand(0,$product_imgs_lenght)],
        ];
    }
}
