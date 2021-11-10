<?php

namespace App\Models;

use App\Mail\MovieUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'director_id',
        'user_id'
    ];

    protected static function booted()
    {
        static::updated(function ($movie) {

            Mail::to($movie->user)->send(new MovieUpdated($movie, $movie->user));

        });
    }

    public function actors() {
        return $this->belongsToMany(Actor::class);
    }

    public function director() {
        return $this->belongsTo(Director::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
