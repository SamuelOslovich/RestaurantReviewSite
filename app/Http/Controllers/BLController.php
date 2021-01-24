<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BLController extends BaseController
{
    //Returns the main view with all the restaurants
    function getRestaurants()
    {
        return view('index', ['restaurants' => Restaurant::get()]);
    }

    //Returns the main view with all the restaurants sorted by avg rating
    function getRestaurantsSorted()
    {
        return view('index', ['restaurants' => Restaurant::get()->sortByDesc('avgRating')]);
    }

    //Returns the page for a restaurant with all the reviews
    function getReviews($id)
    {
        return view('viewrestaurant', [
            'reviews' => Review::where('restaurantID', $id)->get(),
            'restaurant' => Restaurant::where('id', $id)->first()
        ]);
    }

    //Returns the page for a restaurant with all the reviews sorted by rating
    function getReviewsSortedAvg($id)
    {
        return view('viewrestaurant', [
            'reviews' => Review::where('restaurantID', $id)->get()->sortByDesc('rating'),
            'restaurant' => Restaurant::where('id', $id)->first()
        ]);
    }

    //Returns the page for a restaurant with all the reviews sorted by order posted
    function getReviewsSortedPostOrder($id)
    {
        return view('viewrestaurant', [
            'reviews' => Review::where('restaurantID', $id)->get()->sortBy('review_id'),
            'restaurant' => Restaurant::where('id', $id)->first()
        ]);
    }

    //Adds a new restaurant to the database
    function addNewRestaurant(Request $request) 
    {
        //Validates the request data
        $validatedRequest = $request->validate([
            'name' => ['required', 'min:3'],
            'location' => ['required'],
            'picture' => ['required', 'image']
        ]);

        $file = $request->file('picture'); //Gets the file
        $filename = time().$file->getClientOriginalName(); //Names the file using the current time to ensure uniqueness

        //Creates a new restaurant model and saves to DB
        $restaurant = new Restaurant;
        $restaurant->name = $request->input('name');
        $restaurant->location = $request->input('location');
        $restaurant->picture = $filename;
        $restaurant->avgRating = 0;
        
        $restaurant->save();

        //Saves file to images folder 
        $file->move('images', $filename);

        return redirect('/');
    }

    //Adds a new review to the database and updates average rating
    function addNewReview(Request $request, $id)
    {
        //Validates the request data
        $validatedRequest = $request->validate([
            'title' => ['required'],
            'body' => ['required'],
            'rating' => ['required', 'integer', 'min:1', 'max:10']
        ]);

        //Creates a new review model and saves to DB
        $review = new Review;
        $review->title = $request->input('title');
        $review->body = $request->input('body');
        $review->rating = $request->input('rating');
        $review->restaurantID = intval($id);

        $review->save();
        
        //Gets the average rating and updates the database
        $reviews = Review::where('restaurantID', $id)->get();
        $totalRating = 0;
        $totalRatings = count($reviews);

        foreach ($reviews as $review) {
            $totalRating += $review->rating;
        }

        $avgRating = $totalRating / $totalRatings;
        Restaurant::where('id', $id)->update(['avgRating' => $avgRating]);

        return redirect('/viewRestaurant/'.$id);
    }
}
