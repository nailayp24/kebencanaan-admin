<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CreateDefaultUsers::class,
            CreateUsersDummy::class,
            CreateKejadianBencanaDummy::class,
            CreateWargaDummy::class,
            CreatePoskoBencanaDummy::class,
            CreateDonasiBencanaDummy::class,
            CreateLogistikBencanaDummy::class,
            CreateDistribusiLogistikDummy::class,
        ]);
    }
}
