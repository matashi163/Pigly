<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'date' => now(),
            'weight' => $this->faker->randomFloat(1, 70.0, 80.0),
            'calories' => $this->faker->numberBetween(2000, 3000),
            'exercise_time' => $this->faker->time('H:i'),
            'exercise_content' => $this->faker->randomElement(['ジョギング', 'ウォーキング', 'スポーツ', '筋トレ']),
        ];
    }
}
