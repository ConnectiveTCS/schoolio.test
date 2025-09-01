<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TenantClasses>
 */
class TenantClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id' => 1, // or use a factory if available
            'name' => $this->faker->randomElement(['MYP1', 'MYP2', 'MYP3', 'MYP4', 'MYP5', 'GED1', 'GED2', 'DP1', 'DP2']),
            'subject' => $this->faker->randomElement(['Math', 'Science', 'English', 'History', 'Art']),
            'description' => $this->faker->sentence(),
            'room' => $this->faker->randomElement(['A101', 'B202', 'C303', 'D404']),
            'schedule' => json_encode([
                'monday' => '09:00-10:00',
                'wednesday' => '11:00-12:00',
            ]),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
