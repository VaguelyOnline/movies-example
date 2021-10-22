@extends('layouts.main')

@section('content')

    <h2 class="mt-4">Create a new movie</h2>

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('movies.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <label for="input-title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="input-title"
                    value="{{ old('name') }}" 
                    name="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>
            </div>
            <div class="row mb-3">
                <label for="input-desc" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                <input value="{{ old('description') }}" type="text" class="form-control" id="input-desc" name="description">
            </div>
            </div>

            <div class="row mb-3">
                <label for="input-image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                <input value="{{ old('image') }}" type="text" class="form-control" id="input-image" name="image">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            </div>

            <div class="row mb-3">
                <label for="input-director" class="col-sm-2 col-form-label">Director</label>
                <div class="col-sm-10">
                    <select value="{{ old('director_id') }}" name="director_id" id="input-director" class="form-select" aria-label="Default select example">
                        <option disabled selected>-- Select director --</option>

                        @foreach ($directors as $director)
                            <option value="{{ $director->id }}">{{ $director->name }}</option>    
                        @endforeach
                        
                        
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        </div>
    </div>

@endsection