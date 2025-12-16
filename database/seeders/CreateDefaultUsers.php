<?php
// database/seeders/CreateDefaultUsers.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateDefaultUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@sitaga.id',
                'password' => 'Super123',
                'role' => 'super_admin',
            ],
            [
                'name' => 'Naila Y',
                'email' => 'nailay@pcr.ac.id',
                'password' => 'Naila123',
                'role' => 'super_admin',
            ],
            [
                'name' => 'Admin Bencana',
                'email' => 'admin@sitaga.id',
                'password' => 'Admin123',
                'role' => 'admin',
            ],
            [
                'name' => 'User',
                'email' => 'user@sitaga.id',
                'password' => 'User1234',
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('User default berhasil dibuat:');
        foreach ($users as $user) {
            $this->command->info("- {$user['name']} ({$user['email']} / {$user['password']}) - Role: {$user['role']}");
        }
    }
}
