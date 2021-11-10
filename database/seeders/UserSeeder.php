<?php

namespace Database\Seeders;

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

        ]);
    }

    private function createSecondUserNoPermissions()
    {
        User::create([
            'name' => 'Loreto',
            'email' => 'loreto@email.com',
            "password" => Hash::make('password'),
        ]);
    }
}
