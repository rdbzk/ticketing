<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'API user',
            'email' => 'test@example.com',
        ]);

        // Create a hard-coded set of data for this proof of concept
        $this->call([
            CitySeeder::class,
            AirportSeeder::class,
            FlightSeeder::class,
        ]);
    }
}
