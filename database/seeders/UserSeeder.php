<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker =
        $users = collect(User::all()->modelKeys());
        $data = [];

        for ($i = 0; $i < 180000; $i++)
        {
            $data[] = [
              'name' => fake()->name,
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ];
        }
        foreach (array_chunk($data , 1000) as $chunk)
        {
            User::insert($chunk);
        }
    }
}
