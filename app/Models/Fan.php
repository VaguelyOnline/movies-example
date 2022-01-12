<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function actor() {
        return $this->belongsTo(Actor::class);
    }
}
