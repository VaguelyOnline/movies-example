@extends('layouts.app')

@section('content')

    <h1>
        {{ $movie->name }}
    </h1>

    <img src="{{ $movie->image }}" alt="" class="img-fluid">

    <div class="row">
        <div class="col-md-6 col-md-offset-4">
            <p>
                {{ $movie->description }}
            </p>
        </div>
    </div>

@endsection