<?php

namespace Database\Factories;

use App\Models\CalendarEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CalendarEvent>
 */
class CalendarEventFactory extends Factory
{
    protected $model = CalendarEvent::class;

    public function definition(): array
    {
        $start = now()->addDays($this->faker->numberBetween(1, 30))->setTime(9, 0);
        $end = (clone $start)->addHours(2);
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'type' => $this->faker->randomElement(['event', 'exam', 'holiday']),
            'start_at' => $start,
            'end_at' => $end,
            'all_day' => false,
            'target_roles' => null,
            'is_published' => true,
            'created_by' => User::factory(),
        ];
    }
}
