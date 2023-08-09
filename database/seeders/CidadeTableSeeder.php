<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Database\Factories\CidadeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = array_keys(CidadeFactory::$cities);

        collect($states)->each(
            fn($state) => collect(CidadeFactory::$cities[$state])->each(function ($city) use ($state) {
                Cidade::factory()->create(['nome' => $city, 'estado' => $state]);
            })
        );
    }
}
