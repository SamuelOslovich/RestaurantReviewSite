<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $numRestaurants = count(\DB::table('restaurants')->get()); //Total number of restaurants

        $restaurantID = rand(1, $numRestaurants); 

        \DB::table('reviews')->insert([
            'title' => Str::random(10),
            'body' => Str::random(30),
            'rating' => rand(1, 10),
            'restaurantID' => $restaurantID
        ]);

        //Updates average rating
        $reviews = \DB::table('reviews')->where('restaurantID', $restaurantID)->get();
        $totalRating = 0;
        $totalRatings = count($reviews);

        foreach ($reviews as $review) {
            $totalRating += $review->rating;
        }

        $avgRating = $totalRating / $totalRatings;
        \DB::table('restaurants')->where('id', $restaurantID)->update(['avgRating' => $avgRating]);
    }
}
