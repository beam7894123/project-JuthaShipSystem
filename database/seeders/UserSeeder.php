<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email= 'admin@gmail.com';
        $user->password = Hash::make("password");
        $user->role = 'ADMIN';
        $user->save();

        $user = new User();
        $user->name = 'Captain';
        $user->email = 'captain@gmail.com';
        $user->password = Hash::make("password");
        $user->role = 'CAPTAIN';
        $user->journey_id = 1;
        $user->save();

        $user = new User();
        $user->name = 'Engineer';
        $user->email = 'engineer@gmail.com';
        $user->password = Hash::make("password");
        $user->role = 'ENGINEER';
        $user->journey_id = 1;
        $user->save();

        $user = new User();
        $user->name = 'Chief Officer';
        $user->email = 'chief@gmail.com';
        $user->password = Hash::make("password");
        $user->role = 'CHIEF';
        $user->journey_id = 1;
        $user->save();

        $user = new User();
        $user->name = 'Crew';
        $user->email = 'crew@gmail.com';
        $user->password = Hash::make("password");
        $user->role = 'CREW';
        $user->journey_id = 1;
        $user->save();

        $user = User::factory()->count(50)->create();
    }
}
