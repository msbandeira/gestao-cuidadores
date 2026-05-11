<?php

namespace Database\Seeders;

use App\Models\Professional;
use Illuminate\Database\Seeder;

class ProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cria 20 profissionais
        Professional::factory(20)->create();
    }
}