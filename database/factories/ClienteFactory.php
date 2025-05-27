<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use App\Models\Cliente;
use App\Models\Cidade;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerBR = FakerFactory::create('pt_BR');

        $cidade = Cidade::inRandomOrder()->first();

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
            'cidade_id' => $cidade ? $cidade->id : null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
