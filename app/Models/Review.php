<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'rating',
        'restaurantID'
    ];

    protected $primaryKey = 'review_id';
    public $timestamps = false;
}
