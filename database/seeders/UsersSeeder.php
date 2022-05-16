<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'      => 'Jon Doe',
            'email'     => 'JonDoe@example.test',
            'password'  => bcrypt('password')
        ]);

        $user->createToken('Jon Doe')->plainTextToken;

        User::factory()->count(5)->create();
    }
}
