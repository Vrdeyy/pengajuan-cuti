<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\LeaveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default Leave Types
        LeaveType::firstOrCreate(['name' => 'Cuti Tahunan'], ['is_deductible' => true]);
        LeaveType::firstOrCreate(['name' => 'Sakit'], ['is_deductible' => false]);
        LeaveType::firstOrCreate(['name' => 'Cuti Khusus'], ['is_deductible' => false]);

        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@cuti.com'],
            [
                'name' => 'Admin HR',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // Staff User
        User::firstOrCreate(
            ['email' => 'staff@cuti.com'],
            [
                'name' => 'John Staff',
                'password' => bcrypt('password'),
                'role' => 'user',
                'leave_balance' => 12,
            ]
        );

        // Generate 15 Random Users with Leave Requests
        User::factory(15)->create(['role' => 'user', 'leave_balance' => 12])->each(function ($user) {
            $user->leaveRequests()->saveMany(\App\Models\LeaveRequest::factory(rand(1, 5))->make());
        });
    }
}
