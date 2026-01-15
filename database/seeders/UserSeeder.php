<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    // public function run(): void
    // {
    //     $admin = User::create([
    //         'name' => 'Admin User',
    //         'email' => 'admin@example.com',
    //         'password' => Hash::make('password'),
    //     ]);

    //     $admin->assignRole(UserRole::ADMIN->value);
    // }
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            // Directly assign the admin role from the enum
            'role' => UserRole::ADMIN->value,
        ]);

        // Create an Student  user  Default
        User::create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('student123'),
            // The default role 'student' will be applied automatically if not specified
        ]);

        // Create an COMMUNITY_MEMBER  user
        User::create([
            'name' => 'Coummnity Member',
            'email' => 'communitymember@gmail.com',
            'password' => Hash::make('comunitymember123'),
            'role' => UserRole::COMMUNITY_MEMBER->value,
        ]);

        // Create an COMMUNITY_CHAIR  user
        User::create([
            'name' => 'Communitychair',
            'email' => 'communitychair@gmail.com',
            'password' => Hash::make('chmmunitychair123'),
            'role' => UserRole::COMMUNITY_CHAIR->value,
        ]);

        // Create an PRESIDENT  user
        User::create([
            'name' => 'President',
            'email' => 'president@gmail.com',
            'password' => Hash::make('president123'),
            'role' => UserRole::PRESIDENT->value,
        ]);

        // Create an VICE_PRESIDENT  user
        User::create([
            'name' => 'Vice president',
            'email' => 'vicepresident@gmail.com',
            'password' => Hash::make('vicepresident123!@#'),
            'role' => UserRole::VICE_PRESIDENT->value,
        ]);
    }
}
