<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Inserting roles
         DB::table('roles')->insert([
            [
                'name' => 'user',
            ],
            [
                'name' => 'organizer',
            ],
            [
                'name' => 'admin',
            ],
        ]);

    }
}
