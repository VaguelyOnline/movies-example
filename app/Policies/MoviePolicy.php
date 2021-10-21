<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user) {
        return $user->id == 4;
    }

    /**
     * @return bool true if the user may view the given movie
     */
    public function view(User $user, Movie $movie) {
        return true;
    }

    public function destroy(User $user, Movie $movie) {
        return $user->id == $movie->user_id;
    }
}
