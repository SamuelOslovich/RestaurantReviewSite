<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <title>Restaurant Reviewer</title>
    </head>

    <body>
        <ul id="navbar">
            <li class="nav-element"><a class="active" href="/">Home</a></li>
            <li class="nav-element"><a href="/addRestaurant">Add a Restaurant</a></li>
        </ul>

        <button onClick="window.location.replace('/sorted')">Sort by Avg Rating</button>
        <button onClick="window.location.replace('/')">Unsort</button>

        <div id="restaurant-card-container">
            {{-- Create a card for each $restaurant --}}
            @foreach ($restaurants as $restaurant)
                    <div class="restaurant-card">
                        <a class="restaurant-link" href="/viewRestaurant/{{ $restaurant->id }}">
                            <img class="restaurant-card-img" src="/images/{{ $restaurant->picture }}" />
                            <h2> {{ $restaurant->name }} </h2>
                            <h3> {{ $restaurant->location }} </h3>

                            {{-- Rounds the average rating and displays the rounded rating in stars --}}
                            @php ($count = round($restaurant->avgRating))
                            @for ($i = 0; $i < 10; $i++)
                                @if ( $count > 0)
                                    <span class="fa fa-star" style="color: orange"></span>
                                    @php ($count--)
                                @else
                                    <span class="fa fa-star"></span>
                                @endif
                            @endfor

                            <br>
                            @if ($restaurant->avgRating == 0)
                                <label>No Ratings Yet</label>
                            @else
                                <label>Average Rating: {{ round($restaurant->avgRating, 2) }} / 10</label>
                            @endif
                        </a>
                    </div> 
            @endforeach
        </div>
    
    </body>
</html>