@extends('layouts.app')

@section('content')

    <h1>
        All movies!
    </h1>

    <div class="row">

        @if($movies->hasPages())
            {{ $movies->links() }}
        @endif
        
        @foreach ($movies as $movie)
            <div class="col-4">
                @include('components.movies.summary')
            </div>
        @endforeach

    </div>

@endsection