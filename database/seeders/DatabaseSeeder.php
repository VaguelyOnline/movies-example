<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MovieSeeder::class);
        $this->call(ActorSeeder::class);
        $this->call(DirectorSeeder::class);
    }
}
