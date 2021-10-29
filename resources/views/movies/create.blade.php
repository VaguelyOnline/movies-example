@extends('layouts.main')

@section('content')

    <h2 class="mt-4">Create a new movie</h2>

    <div class="row">
        <div class="col-md-6">
            @include('components.movies.new-movie-form')
        </div>
    </div>

@endsection