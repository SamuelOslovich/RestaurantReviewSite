<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>{{ $restaurant->name }}</title>
    </head>

    <body id="restaurant-view">
        <ul id="navbar">
            <li class="nav-element"><a href="/">Home</a></li>
            <li class="nav-element"><a href="/addRestaurant">Add a Restaurant</a></li>
        </ul>
        
        <div id="main-view" class="center">
            <img id="restaurant-view-img" src="/images/{{ $restaurant->picture }}" />
            <h2> {{ $restaurant->name }} </h2>
            <h3> {{ $restaurant->location }} </h3>

            <div id="review-container">
                <div>
                    <h3> Reviews: </h3>
                    <button onClick="window.location.replace('/viewRestaurant/sortedAvg/{{$restaurant->id}}')">Sort by Avg Rating</button>
                    <button onClick="window.location.replace('/viewRestaurant/sortedPostOrder/{{$restaurant->id}}')">Sort by Post Order</button>
                    <button onClick="window.location.replace('/viewRestaurant/{{$restaurant->id}}')">Unsort</button>
                    <button onclick="openReviewForm()">Add a new review</button>
                </div>
                <br>
                <br>

                {{-- Displays each review for the restaurant --}}
                @foreach ($reviews as $review)
                <div class="review-card">
                    <h4> {{ $review->title }} </h4>

                    {{-- Displays the review rating as stars --}}
                    @php ($count = $review->rating)
                    @for ($i = 0; $i < 10; $i++)
                        @if ( $count > 0)
                            <span class="fa fa-star" style="color: orange"></span>
                            @php ($count--)
                        @else
                            <span class="fa fa-star"></span>
                        @endif
                    @endfor

                    <span> {{ $review->rating }} / 10 </span>
                    <p> {{ $review->body }}</p>

                </div>
                @endforeach  
                
            </div>
        </div>  

        <div class="hidden center" id="add-review-form">
            
            {{-- Displays form validation errors --}}
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            <button style="float:right" onClick="window.location.reload()">Close X</button>

            {{-- A form that allows the user to submit a new review --}}
            {{ Form::open(array('url' => 'addNewReview/'.$restaurant->id)) }}
                {{ Form::label('title', 'Title:') }}
                {{ Form::text('title') }}
                <br>
                {{ Form::label('body', 'Review:') }}
                {{ Form::textarea('body') }}
                <br>
                {{ Form::label('rating', 'Rating:') }}
                {{ Form::selectRange('rating', 1, 10) }}
                <br>
                <br>
                {{ Form::submit('Submit') }}
            {{ Form::close() }}
        </div>

        
        {{-- Shows the form if there are any validation errors --}}
        @if ($errors->any())
            <script type="text/javascript">
                var form = document.getElementById("add-review-form");
                var view = document.getElementById("review-container");

                form.classList.remove("hidden");
                view.classList.add("hidden");
                window.scrollTo(0,document.body.scrollHeight);
            </script>
        @endif
        
        <script type="text/javascript">
            function openReviewForm()
            {
                var form = document.getElementById("add-review-form");
                var view = document.getElementById("review-container");

                form.classList.remove("hidden");
                view.classList.add("hidden");
                window.scrollTo(0,document.body.scrollHeight);
            }
        </script>
    </body>
</html>