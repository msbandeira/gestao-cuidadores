<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Definir o Gate 'acessar-admin'
        Gate::define('acessar-admin', function ($user) {
            return $user->isAdmin(); // O método isAdmin() que criamos no modelo User
        });

        // Definir o Gate 'acessar-cliente-profissional-atendimento'
        Gate::define('acessar-cliente-profissional-atendimento', function ($user) {
            // Tanto administradores quanto usuários comuns podem acessar estes módulos
            return $user->isAdmin() || $user->role->name === 'usuario_comum';
        });

        // Você pode criar Gates mais específicos conforme a necessidade.
        // Ex: Gate::define('ver-receita', function ($user) { return $user->isAdmin(); });
    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
