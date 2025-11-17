<?php
// database/seeders/CreateFirstUser.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'nailay@pcr.ac.id',
            'password' => Hash::make('naila')
        ]);

        $this->command->info('User pertama berhasil dibuat: nailay@pcr.ac.id / naila');
    }
}
