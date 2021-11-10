<html>

    <body>
        <h1>
            Movie updated!
        </h1>

        <p>
            Hi {{ $user->name }}, your movie {{ $movie->name }} was 
            updated. <a href="{{ route('movies.show', $movie) }}">Click for details</a>.
        </p>
    </body>

</html>