<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        return [
            'title' => $faker->sentence(10),
            'content' => $faker->paragraph(5,true)
        ];
    }
    public function state($state)
    {
        if($state === "new-title") {
            return [
                'title' => 'New title',
                'content' => 'Content of the blog post'
            ];
        }
    }
}
