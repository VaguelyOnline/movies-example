@extends('layouts.main')

@section('content')

    <h1>
        All movies!
    </h1>

    <div class="row">

        {{ $movies->links() }}

        @foreach ($movies as $movie)
            <div class="col-4">
                @include('components.movies.summary')
            </div>
        @endforeach

    </div>

@endsection