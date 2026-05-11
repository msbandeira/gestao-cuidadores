<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Child;
use Illuminate\Database\Seeder;

class DependentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pega todos os clientes que foram criados no seeder anterior
        $clients = Client::all();

        // Itera sobre cada cliente e cria 1 dependente para ele
        foreach ($clients as $client) {
            Child::factory()->create([
                'client_id' => $client->id,
            ]);
        }
    }
}