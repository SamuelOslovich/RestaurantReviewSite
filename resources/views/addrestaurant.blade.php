<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
        <title>Restaurant Reviewer</title>
    </head>

    <body>
        <ul id="navbar">
            <li class="nav-element"><a href="/">Home</a></li>
            <li class="nav-element"><a class="active" href="/addRestaurant">Add a Restaurant</a></li>
        </ul>
        <div class="center">
            
            {{-- Displays form validation errors--}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- A form to add a new restaurant --}}
            {{ Form::open(array('url' => '/addNewRestaurant', 'files'=>'true')) }}
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name') }}
                <br>
                {{ Form::label('location', 'Location:') }}
                {{ Form::textarea('location') }}
                <br>
                {{ Form::label('picture', 'Picture:') }}
                {{ Form::file('picture') }}
                <br>
                <br>
                {{ Form::submit('Submit') }}
            {{ Form::close() }}
        </div>
    </body>
</html>