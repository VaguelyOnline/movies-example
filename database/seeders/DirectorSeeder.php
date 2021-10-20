<?php

namespace Database\Seeders;

use App\Models\Director;
use App\Models\Movie;
use Faker\Generator;
use Illuminate\Database\Seeder;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        for($i=0; $i<10; $i++)
            Director::create(['name' => $faker->name()]);


        $directors = Director::all();
        
        foreach(Movie::all() as $movie)
        {
            $director = $directors->random();
            $movie->director()->associate($director);
            $movie->save();
        }
    }
}
