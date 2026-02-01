<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 year', 'now');
        $endDate = (clone $startDate)->modify('+' . rand(1, 3) . ' days');
        $status = fake()->randomElement(['pending', 'approved', 'rejected']);

        return [
            'leave_type_id' => rand(1, 3), // Assuming we have 3 default types
            'start_date' => $startDate,
            'end_date' => $endDate,
            'reason' => fake()->sentence(),
            'status' => $status,
            'created_at' => $startDate,
            'updated_at' => $startDate,
        ];
    }
}
