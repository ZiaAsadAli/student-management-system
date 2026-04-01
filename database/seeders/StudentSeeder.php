<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'name'    => 'Ahmed Al-Rashid',
                'email'   => 'ahmed@example.com',
                'program' => 'Master of Computer Science',
                'status'  => 'admitted',
                'gpa'     => 3.85,
                'gender'  => 'male',
                'phone'   => '+92-300-1234567',
                'address' => 'House 12, Street 4, Lahore',
            ],
            [
                'name'    => 'Sara Johnson',
                'email'   => 'sara@example.com',
                'program' => 'Master of Data Science',
                'status'  => 'pending',
                'gpa'     => 3.60,
                'gender'  => 'female',
                'phone'   => '+92-301-2345678',
                'address' => 'Flat 5, Block B, Karachi',
            ],
            [
                'name'    => 'Muhammad Hassan',
                'email'   => 'hassan@example.com',
                'program' => 'Master of Business Administration',
                'status'  => 'admitted',
                'gpa'     => 3.72,
                'gender'  => 'male',
                'phone'   => '+92-302-3456789',
                'address' => 'Street 9, F-10, Islamabad',
            ],
            [
                'name'    => 'Fatima Khan',
                'email'   => 'fatima@example.com',
                'program' => 'Master of Engineering',
                'status'  => 'rejected',
                'gpa'     => 2.90,
                'gender'  => 'female',
                'phone'   => '+92-303-4567890',
                'address' => 'Block 3, Gulshan, Karachi',
            ],
            [
                'name'    => 'John Smith',
                'email'   => 'john@example.com',
                'program' => 'Master of Computer Science',
                'status'  => 'pending',
                'gpa'     => 3.45,
                'gender'  => 'male',
                'phone'   => '+92-304-5678901',
                'address' => 'DHA Phase 5, Lahore',
            ],
            [
                'name'    => 'Aisha Malik',
                'email'   => 'aisha@example.com',
                'program' => 'Master of Education',
                'status'  => 'admitted',
                'gpa'     => 3.91,
                'gender'  => 'female',
                'phone'   => '+92-305-6789012',
                'address' => 'Sector G-11, Islamabad',
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}