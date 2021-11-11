<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFirstUserRootAdmin();
        $this->createSecondUserNoPermissions();
    }

    private function createFirstUserRootAdmin()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('password'),
            'is_admin' => '1'

        ]);
    }
        
    private function createSecondUserNoPermissions()
    {
        User::create([
            'name' => 'Loreto',
            'email' => 'loreto@email.com',
            'password' => Hash::make('password'),
        ]);
    }

}
