<?php

namespace Database\Factories;

use App\Models\Cidade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cidade>
 */
class CidadeFactory extends Factory
{

    protected $model = Cidade::class;

    public static array $cities = [
        'Paraná' => [
            'Londrina',
            'Curitiba',
            'Caiobá',
            'São José dos Pinhais',
        ],
        'Bahia' => [
            'Salvador',
            'Feira de Santana',
            'Maragogipe',
            'Cruz das Almas',
        ],
        'São Paulo' => [
            'São Paulo',
            'Campinas',
            'Diadema',
            'Santos',
        ],
        'Santa Catarina' => [
            'Joinville',
            'Florianópolis',
            'Criciúma',
            'Blumenau',
        ],
        'Rio Grande do Sul' => [
            'Porto Alegre',
            'Gramado',
            'Pelotas',
            'Canela',
        ],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $state = $this->faker->randomElement(array_keys(self::$cities));
        $city = $this->faker->randomElement(self::$cities[$state]);

        return [
            'nome' => $city,
            'estado' => $state,
        ];
    }
}
