<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->text,
            'topic_id' => Topic::inRandomOrder()->first()->id ?? Topic::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()
        ];
    }
}
