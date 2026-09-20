<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'guilherme@teste.com.br')->first()) {
            User::create([
                'name' => 'Guilherme',
                'email' => 'guilherme@teste.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);
        }
        if (!User::where('email', 'henrique@teste.com.br')->first()) {
            User::create([
                'name' => 'Henrique',
                'email' => 'henrique@teste.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);
        }
        if (!User::where('email', 'souza@teste.com.br')->first()) {
            User::create([
                'name' => 'Souza',
                'email' => 'souza@teste.com.br',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);
        }
    }
}
