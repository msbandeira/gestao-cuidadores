<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'administrador')->first();
        $usuarioComumRole = Role::where('name', 'usuario_comum')->first();

        // Cria um usuário administrador se não existir
        if ($adminRole) {
            User::firstOrCreate(
                ['email' => 'admin@email.com'], // Condição para encontrar
                [
                    'name' => 'Administrador do Sistema',
                    'password' => Hash::make('admin123'), // Defina uma senha forte
                    'role_id' => $adminRole->id,
                ]
            );
        }

        // Opcional: Crie um usuário comum de teste
        if ($usuarioComumRole) {
            User::firstOrCreate(
                ['email' => 'usuario@email.com'],
                [
                    'name' => 'Usuário de Teste',
                    'password' => Hash::make('senha123'),
                    'role_id' => $usuarioComumRole->id,
                ]
            );
        }
    }
    
}
