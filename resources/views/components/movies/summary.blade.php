<div class="card summary">
    <img src="{{ $movie->image }}" class="card-img-top" alt="Movie poster image">
    <div class="card-body">
        <h5 class="card-title">
            {{ $movie->name }}
        </h5>

        <a href="{{ route('movies.show', $movie) }}" class="btn btn-primary">
            More details
        </a>
    </div>

</div>