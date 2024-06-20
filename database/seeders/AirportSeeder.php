<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = now();

        $airports = [
            [
                'name'       => 'Paris Charles de Gaulle',
                'code'       => 'CDG',
                'city_id'    => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name'       => 'Stockholm Arlanda',
                'code'       => 'ARN',
                'city_id'    => 2,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name'       => 'Berlin Brandenburg',
                'code'       => 'BER',
                'city_id'    => 3,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]
        ];

        Airport::truncate();
        Airport::insert($airports);
    }
}
