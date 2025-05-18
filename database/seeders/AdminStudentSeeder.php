<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Student;


class AdminStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create initial admin account
        Admin::create([
            'username' => 'superadmin',
            'email' => 'admin@school.edu',
            'password' => Hash::make('securepassword123'), // Always hash passwords!
        ]);

        // Create sample students
        $students = [
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@student.edu',
                'password' => Hash::make('studentpass123'),
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@student.edu',
                'password' => Hash::make('studentpass123'),
            ],
            // Add 3-4 more students here following the same pattern
            [
                'first_name' => 'Alex',
                'last_name' => 'Johnson',
                'email' => 'alex.johnson@student.edu',
                'password' => Hash::make('studentpass123'),
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Williams',
                'email' => 'sarah.williams@student.edu',
                'password' => Hash::make('studentpass123'),
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michael.brown@student.edu',
                'password' => Hash::make('studentpass123'),
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    
    }
}
