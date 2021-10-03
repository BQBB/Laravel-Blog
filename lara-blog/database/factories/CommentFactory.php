<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "text" => $this->faker->text("85"),
            "commentable_id" => $this->faker->numberBetween(1, 13),
            "commentable_type" => 'App\Models\Post',
            "user_id" => $this->faker->numberBetween(1, 5),
        ];
    }
}