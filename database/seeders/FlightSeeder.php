<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = now();

        $flights = [
            [
                'departure_airport_id' => 1,
                'arrival_airport_id'   => 2,
                'departure_at'         => '2024-10-01 10:00:00',
                'arrival_at'           => '2024-10-01 12:00:00',
                'created_at'           => $timestamp,
                'updated_at'           => $timestamp,
            ],
            [
                'departure_airport_id' => 3,
                'arrival_airport_id'   => 2,
                'departure_at'         => '2024-10-02 14:00:00',
                'arrival_at'           => '2024-10-02 15:10:00',
                'created_at'           => $timestamp,
                'updated_at'           => $timestamp,
            ],
        ];

        Flight::truncate();
        Flight::insert($flights);
    }
}
