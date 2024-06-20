<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $timestamp = now();

        $cities = [
            [
                'name'         => 'Paris',
                'country_code' => 'FR',
                'created_at'   => $timestamp,
                'updated_at'   => $timestamp,
            ],
            [
                'name'         => 'Stockholm',
                'country_code' => 'SE',
                'created_at'   => $timestamp,
                'updated_at'   => $timestamp,
            ],
            [
                'name'         => 'Berlin',
                'country_code' => 'DE',
                'created_at'   => $timestamp,
                'updated_at'   => $timestamp,
            ]
        ];

        City::truncate();
        City::insert($cities);
    }
}
