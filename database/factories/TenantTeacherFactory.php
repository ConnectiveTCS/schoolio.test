<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TenantTeacher>
 */
class TenantTeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::create([
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('teacher');

        return [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'subject' => $this->faker->randomElement(['Math', 'Science', 'English', 'History', 'Art']),
            'bio' => $this->faker->paragraph(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'profile_picture' => $this->faker->imageUrl(200, 200, 'people'),
            'hire_date' => $this->faker->date(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
