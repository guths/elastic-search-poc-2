<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'level' => $this->faker->randomElement(['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency']),
            'message' => $this->faker->text(100),
            'context' => $this->faker->sentence,
        ];
    }
}
