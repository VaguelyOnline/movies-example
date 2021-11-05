<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Actor extends Model
{
    use HasFactory;

    public function movies() {
        return $this->belongsToMany(Movie::class);
    }

    public function getNumCostarsForMovie() {

        $numActors = Cache::get('costars', null);

        if ($numActors === null) {
            // work out how many costars
            $numActors = Movie::find(1)->actors()->count();
            Cache::put('costars', $numActors, 60);
        }

        return $numActors;
    }

    public function getNumCostarsForMovie2() {

        $id = 1;
        return Cache::remember('costars', 20, function () use ($id) {
            return Movie::find($id)->actors()->count();
        });
    }
}
