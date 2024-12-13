<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('generes')->insert([
            ['name' => 'Ficció'],
            ['name' => 'No Ficció'],
            ['name' => 'Ciència Ficció'],
            ['name' => 'Fantasia'],
            ['name' => 'Misteri'],
            ['name' => 'Biografia'],
            ['name' => 'Història'],
            ['name' => 'Poesia'],
            ['name' => 'Drama'],
            ['name' => 'Comèdia'],
            ['name' => 'Aventura'],
            ['name' => 'Romàntic'],
            ['name' => 'Terror'],
        ]);
    }
}