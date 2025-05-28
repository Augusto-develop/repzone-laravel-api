<?php

namespace Database\Seeders;

use App\Models\Cidade;
use App\Models\Representante;
use Illuminate\Database\Seeder;

class RepresentanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cidades = Cidade::all();

        Representante::factory()->count(10)->create()->each(function ($representante) use ($cidades) {
            $representante->cidades()->attach(
                $cidades->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
