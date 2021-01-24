<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Gets a random image from the images folder
        $files = File::allFiles(public_path('/images'));
        $randomFile = $files[rand(1, count($files)) - 1];

        \DB::table('restaurants')->insert([
            'name' => Str::random(10),
            'location' => Str::random(20),
            'picture' => $randomFile->getFilename(),
            'avgRating' => 0
        ]);
    }
}
