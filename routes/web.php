<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BLController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BLController::class, 'getRestaurants']);

Route::get('/sorted', [BLController::class, 'getRestaurantsSorted']);

Route::get('/viewRestaurant/{id}', [BLController::class, 'getReviews']);

Route::get('/viewRestaurant/sortedAvg/{id}', [BLController::class, 'getReviewsSortedAvg']);

Route::get('/viewRestaurant/sortedPostOrder/{id}', [BLController::class, 'getReviewsSortedPostOrder']);

Route::get('/addRestaurant', function () {
    return view('addrestaurant');
});

Route::post('/addNewReview/{id}', [BLController::class, 'addNewReview']);

Route::post('/addNewRestaurant', [BLController::class, 'addNewRestaurant']);