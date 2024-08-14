<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => 'Cartagena'],
            ['name' => 'Bogota'],
            ['name' => 'Medellin'],
            ['name' => 'Cali'],
            ['name' => 'Bucaramanga'],
            ['name' => 'Ibague'],
            ['name' => 'Manizales'],
            ['name' => 'Santa Marta'],
            ['name' => 'San Abndres'],
        ]);
    }
}
