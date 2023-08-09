<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'contato@facilconsulta.com.br';

        if (!User::where('email', $email)->exists()) {
            User::create([
                'name' => 'Dev',
                'email' => $email,
                'password' => '#Facil@Consulta#2023',
            ]);
        }
    }
}
