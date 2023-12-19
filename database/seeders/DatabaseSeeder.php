<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TruckSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\TrailerSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\DocumentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $this->call([
            DocumentSeeder::class,
            TrailerSeeder::class,
            TruckSeeder::class,
            CustomerSeeder::class,
            CompanySeeder::class
        ]);
    }
}
