<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Movie;
use Faker\Generator;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        // create 
        for($i = 0; $i < 20; $i++)
            Actor::create([
                'name' => $faker->name,
                'dob' => now()->subYears(25),
                'image' => 'https://www.placecage.com/g/200/' . (300 + $i),
                'bio' => $faker->text()
            ]);

        $actors = Actor::all();
        foreach(Movie::all() as $movie)
            $movie->actors()->sync($actors->random(10));

        
    }
}
