<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::makeDirectory('project_images');
        $title = fake()->text(30);
        $slug = Str::slug($title);
        //la funzione non sta funzionando
        $img = fake()->image(null, 200, 200);
 
        $img_url = Storage::putFileAs('project_images', $img , "$slug.png"); 

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => fake()->paragraphs(8, true),
            'image' => $img_url,
        ];
    }
}
