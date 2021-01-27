<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'title' => $this->faker->title,
            'snipped' => $this->faker->paragraph,
            'position' => $this->faker->randomNumber(),
            'selected' => $this->faker->boolean,
            'authors' => $this->faker->shuffleArray(),
            'thumbnail' => $this->faker->url,
            'smallThumbnail' => $this->faker->url,
            'publishedDate' => $this->faker->dateTime
        ];
    }
}
