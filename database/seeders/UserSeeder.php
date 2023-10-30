<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     "name" => "User",
        //     "username" => "user",
        //     "password" => bcrypt("user"),
        //     "role" => "user"
        // ]);

        User::create([
            "name" => "Atnos Sub",
            "username" => "atnos",
            "password" => bcrypt("atnos"),
            "role" => "admin"
        ]);
    }
}
