<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\ActorResource;
use App\Models\Actor;
use App\Models\Director;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:destroy,movie')->only([
            'destroy'
        ]);

        $this->middleware('can:create,' . Movie::class)->only([
            'create',
            'store'
        ]);

        $this->middleware('can:update,movie')->only([
            'update'
        ]);

        $this->middleware('can:view,movie')->only([
            'getActors'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::paginate(9);
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $directors = Director::orderBy('name', 'asc')->get();
        return view('movies.create', compact('directors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        $movie = Auth::user()->movies()->create($request->validated());
        return redirect()->route('movies.show', $movie);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {

        // return $movie->actors()->where('name', 'like', '%R%')->get();
        // return $movie->actors()->count();
        // return $movie->actors()->get(); 
        // return $movie->actors;

        $movie->load('actors.movies');
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    /**`
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('message', 'Movie deleted');
    }

    public function getActors(Request $request, Movie $movie)
    {
        return ActorResource::collection($movie->actors);
    }

    public function addActor(Movie $movie, Actor $actor)
    {

    }
}
