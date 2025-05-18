<?php

return [
    'defaults' => [
        'guard' => 'student', // Set default guard to student
        'passwords' => 'students', // Default password reset for students
    ],

    'guards' => [
        'student' => [
            'driver' => 'session',
            'provider' => 'students',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

    'providers' => [
        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    'passwords' => [],

    'password_timeout' => 10800, // 3 hours in seconds
];