@extends('layouts.main')

@section('content')

    <h1>
        All movies!
    </h1>

    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="row">

        {{ $movies->links() }}

        @foreach ($movies as $movie)
            <div class="col-4">
                @include('components.movies.summary')
            </div>
        @endforeach

    </div>

@endsection