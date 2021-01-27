<?php

namespace Database\Factories;

use App\Entities\Book;
use App\Models\UserBooksCollection;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserBooksCollectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserBooksCollection::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $book = collect(Book::factory()->make());
        return [
            'id' => $this->faker->numberBetween(1, 100),
            'user_id' => $this->faker->numberBetween(1, 100),
            'books_collection' => $book
        ];
    }
}
