<?php
// database/seeders/CreateUsersDummy.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class CreateUsersDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Hapus data lama jika ada
        User::truncate();
    

        // 2. Buat 197 user dummy (total jadi 200)
        for ($i = 1; $i <= 197; $i++) {
            $firstName = $faker->firstName();
            $lastName = $faker->lastName();
            $name = $firstName . ' ' . $lastName;
            $email = strtolower($firstName . '.' . $lastName . '@sitaga.id');

            // Pastikan email unique
            $email = $this->makeUniqueEmail($email, $i);

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password123'),
                'email_verified_at' => $faker->boolean(80) ? now() : null,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }

    private function makeUniqueEmail($baseEmail, $index)
    {
        if (!User::where('email', $baseEmail)->exists()) {
            return $baseEmail;
        }

        $parts = explode('@', $baseEmail);
        return $parts[0] . $index . '@' . $parts[1];
    }
}
