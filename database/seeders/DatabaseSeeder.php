<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 5; $i++)
        {
            $this->call([
                RestaurantSeeder::class,
            ]);
        }

        for($i = 0; $i < 20; $i++)
        {
            $this->call([
                ReviewSeeder::class
            ]);
        }
    }
}
