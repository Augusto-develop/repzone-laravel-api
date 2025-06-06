<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::truncate();
        User::factory()->create([
            'name' => 'Dev User',
            'email' => 'dev@email.com',
            'password' => Hash::make('123456'),
        ]);

        $this->call([
            CidadeSeeder::class,
            ClienteSeeder::class,
            RepresentanteSeeder::class,
        ]);
    }
}
