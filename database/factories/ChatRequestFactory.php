<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatRequest>
 */
class ChatRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => 'gpt-3.5-turbo',
            'request_text' => 'Tell about {uri}.',
            'styles' => '["William Shakespeare", "Mark Twain"]',
            'temperature' => 1,
            'max_tokens' => 4000,
            'presence_penalty' => 0,
            'frequency_penalty' => 0,
        ];
    }
}
