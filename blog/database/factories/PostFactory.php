<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_ids = User::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($user_ids),
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
