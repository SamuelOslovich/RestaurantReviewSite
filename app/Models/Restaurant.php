<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
        'picture',
        'avgRating'
    ];

    protected $primaryKey = 'restaurant_id';
    public $timestamps = false;
}
