<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Announcements;
use App\Models\Project;
use App\Models\ProjectWishlists;
class BaseSeeder extends Seeder
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
            'password' => Hash::make('securepassword123'),
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

        // Create announcements - fixed version
        $announcements = [
            [
                'title' => 'Welcome to the New Academic Year',
                'content' => 'We welcome all students and faculty to the new academic year 2023-24. Classes begin on September 1st.',
                'dept' => 'general',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Computer Science Lab Maintenance',
                'content' => 'The CS lab will be closed for maintenance on October 5th and 6th. Please plan your work accordingly.',
                'dept' => 'computer_science',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Mathematics Workshop Announcement',
                'content' => 'There will be a workshop on Advanced Calculus techniques on November 15th. Register by November 10th.',
                'dept' => 'maths',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Physics Department Seminar',
                'content' => 'Guest lecture on Quantum Mechanics by Dr. Smith from MIT. All physics students are encouraged to attend.',
                'dept' => 'physics',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Chemistry Lab Safety Training',
                'content' => 'Mandatory safety training for all chemistry students on September 10th at 2 PM in Lab B.',
                'dept' => 'chemistry',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'University Sports Day',
                'content' => 'Annual sports day will be held on December 5th. Register your teams by November 20th.',
                'dept' => 'general',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'CS Coding Competition',
                'content' => 'Department of Computer Science is organizing a coding competition on October 20th. Prizes for top 3 winners!',
                'dept' => 'computer_science',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Math Tutoring Sessions',
                'content' => 'Free tutoring sessions for Calculus I students every Thursday from 3-5 PM in Math Building Room 204.',
                'dept' => 'maths',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'CS Internship Fair 2023',
                'content' => 'Annual CS Internship Fair will be held on October 25th in the Tech Building Atrium. Over 30 companies will be recruiting! Bring your resumes.',
                'dept' => 'computer_science',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'New AI Research Lab Opening',
                'content' => 'The department is proud to announce the opening of our new AI Research Lab on November 1st. All CS students are invited to the opening ceremony at 3 PM.',
                'dept' => 'computer_science',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($announcements as $announcement) {
            Announcements::create($announcement);
        }

            $projects = [
        [
            'title' => 'AI-Powered Chatbot Development',
            'description' => 'Building a conversational AI chatbot using Python and NLP techniques to improve customer service interactions.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Blockchain-Based Voting System',
            'description' => 'A secure digital voting platform leveraging Ethereum smart contracts to ensure transparency and prevent fraud.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Quantum Entanglement Experiments',
            'description' => 'Investigating quantum entanglement phenomena using photon pairs in a controlled laboratory environment.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Nanomaterial Catalysis Research',
            'description' => 'Developing new nanomaterials for catalytic applications in sustainable chemical reactions.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Topological Data Analysis',
            'description' => 'Applying topological methods to analyze complex high-dimensional datasets in mathematical modeling.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Machine Learning for Drug Discovery',
            'description' => 'Using neural networks to predict molecular properties and accelerate pharmaceutical research.',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    foreach ($projects as $project) {
            Project::create($project);
        }



    // Get the first student
        $student = Student::first();
        
        // Get the first 5 projects
        $projects = Project::take(5)->get();
        
        // Check if we have both student and projects
        if ($student && $projects->count() > 0) {
            // Add projects to student's wishlist
            foreach ($projects as $project) {
                ProjectWishlists::create([
                    'student_id' => $student->id,
                    'project_id' => $project->id
                ]);
                
                // Alternative using the relationship:
                // $student->wishlistedProjects()->attach($project->id);
            }
            
            $this->command->info('Added 5 projects to first student\'s wishlist!');
        } else {
            $this->command->error('No student or projects found!');
        }
    }

    
}
