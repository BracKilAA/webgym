<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\User;
use Illuminate\Support\Str;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'telefono' => fake()->phoneNumber(),
                'tipo' => 'cliente', // si usas un campo para distinguir
                'fecha_inscripcion' => now()->subDays(rand(0, 365)),
                'password' => bcrypt('12345678'), // o lo que uses
                'remember_token' => Str::random(10),
            ]);
        }
    }
}


