<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $t= $this->faker->text(15);
        return [
            "title" =>$t,
            "body" => $this->faker->text("75"),
            "img" => "https://source.unsplash.com/random",
            "user_id" => $this->faker->numberBetween(1, 5),
            "slug" => Str::slug($t, "-"),
        ];
    }
}
