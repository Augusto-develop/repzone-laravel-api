<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerBR = FakerFactory::create('pt_BR');

        $estadosBR = [
            'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA',
            'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN',
            'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'
        ];

        return [
            'cpf' => $fakerBR->unique()->cpf(false),
            'nome' => $fakerBR->name(),
            'datanasc' => $fakerBR->date('Y-m-d', '2005-12-31'),
            'sexo' => $fakerBR->randomElement(['M', 'F']),
            'endereco' => $fakerBR->address(),
            'estado' => $fakerBR->randomElement($estadosBR),
            'cidade' => $fakerBR->city(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
