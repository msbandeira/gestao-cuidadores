<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ServicePlanController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\ProfessionalPaymentController;
use App\Http\Controllers\RevenueController; 
use App\Http\Controllers\ExpenseController; 
use App\Http\Controllers\CashFlowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    // --- Rotas protegidas pelo Gate 'acessar-cliente-profissional-atendimento'
    Route::middleware('can:acessar-cliente-profissional-atendimento')->group(function () {
        
        // --- Modulo de clientes
        Route::get('/clients', [ClientController::class, 'index'])->name('clients.index'); // Lista de clientes
        Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create'); // Formulário inicial cliente
        Route::post('/clients', [ClientController::class, 'store'])->name('clients.store'); // Salva cliente

        // --- Rotas para edição de cliente
        Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
        Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');

        // --- Rotas para cadastro de filhos
        Route::get('/clients/{client}/children/create', [ClientController::class, 'createChild'])->name('children.create'); // Formulário filho
        Route::post('/clients/{client}/children', [ClientController::class, 'storeChild'])->name('children.store'); // Salva filho

        // --- Rotas para edição de filhos
        Route::get('/clients/{client}/children/{child}/edit', [ClientController::class, 'editChild'])->name('children.edit');
        Route::put('/clients/{client}/children/{child}', [ClientController::class, 'updateChild'])->name('children.update');
        Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show'); // Detalhes do cliente (incluirá filhos)
        
        // --- Rotas do Módulo de Atendimentos (acessíveis por usuario_comum e admin) ---
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
        Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
        Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
        Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    });

        // --- Rotas protegidas pelo Gate 'Administrador do sistema'
    Route::middleware('can:acessar-admin')->group(function () {
        // --- Rotas do Módulo de Profissionais ---
        Route::get('/professionals', [ProfessionalController::class, 'index'])->name('professionals.index');
        Route::get('/professionals/create', [ProfessionalController::class, 'create'])->name('professionals.create');
        Route::post('/professionals', [ProfessionalController::class, 'store'])->name('professionals.store');
        Route::get('/professionals/{professional}', [ProfessionalController::class, 'show'])->name('professionals.show');
        Route::get('/professionals/{professional}/edit', [ProfessionalController::class, 'edit'])->name('professionals.edit');
        Route::put('/professionals/{professional}', [ProfessionalController::class, 'update'])->name('professionals.update');
    
        // --- Rotas do Módulo de Planos de Serviço
        Route::get('/service-plans', [ServicePlanController::class, 'index'])->name('service_plans.index');
        Route::get('/service-plans/create', [ServicePlanController::class, 'create'])->name('service_plans.create');
        Route::post('/service-plans', [ServicePlanController::class, 'store'])->name('service_plans.store');
        Route::get('/service-plans/{servicePlan}', [ServicePlanController::class, 'show'])->name('service_plans.show');
        Route::get('/service-plans/{servicePlan}/edit', [ServicePlanController::class, 'edit'])->name('service_plans.edit');
        Route::put('/service-plans/{servicePlan}', [ServicePlanController::class, 'update'])->name('service_plans.update');
        Route::delete('/service-plans/{servicePlan}', [ServicePlanController::class, 'destroy'])->name('service_plans.destroy');
        
        // --- Rotas do Módulo de Registro de Pagamentos
        Route::get('/professional-payments', [ProfessionalPaymentController::class, 'index'])->name('professional_payments.index');
        Route::get('/professional-payments/create', [ProfessionalPaymentController::class, 'create'])->name('professional_payments.create');
        Route::post('/professional-payments', [ProfessionalPaymentController::class, 'store'])->name('professional_payments.store');
        Route::get('/professional-payments/{payment}', [ProfessionalPaymentController::class, 'show'])->name('professional_payments.show');
        Route::get('/professional-payments/{payment}/edit', [ProfessionalPaymentController::class, 'edit'])->name('professional_payments.edit');
        Route::put('/professional-payments/{payment}', [ProfessionalPaymentController::class, 'update'])->name('professional_payments.update');
        Route::delete('/professional-payments/{payment}', [ProfessionalPaymentController::class, 'destroy'])->name('professional_payments.destroy');

        
        // --- Rotas do Módulo de Dados Bancários de Profissionais (Aninhadas)
        Route::get('/professionals/{professional}/bank-account/edit', [BankAccountController::class, 'edit'])->name('professionals.bank_accounts.edit');
        Route::put('/professionals/{professional}/bank-account', [BankAccountController::class, 'update'])->name('professionals.bank_accounts.update');
        Route::delete('/professionals/{professional}/bank-account', [BankAccountController::class, 'destroy'])->name('professionals.bank_accounts.destroy');
        // Route::delete('/professionals/{professional}', [ProfessionalController::class, 'destroy'])->name('professionals.destroy');
        
        // --- Rota do Dashboard de Fluxo de Caixa
        Route::get('/cash-flow', [CashFlowController::class, 'index'])->name('cash_flow.index');
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // --- Rotas de Entradas (Revenues)
        Route::resource('revenues', RevenueController::class);
        // --- Rotas de Despesas (Expenses)
        Route::resource('expenses', ExpenseController::class);

        // --- Rota do Dashboard
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // --- Rota Gestão de usuarios
        Route::resource('users', UserController::class);
    });

require __DIR__.'/auth.php';
