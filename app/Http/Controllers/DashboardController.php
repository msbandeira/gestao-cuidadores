<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Professional;
use App\Models\Revenue;
use App\Models\Expense;
use App\Models\ProfessionalPayment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        
        // --- Métricas de Atendimentos e Clientes ---
        $totalClients = Client::count();
        $totalProfessionals = Professional::count();

        // Atendimentos agendados para hoje
        $todayAppointments = Appointment::whereDate('appointment_date', Carbon::today())->count();

        // Atendimentos agendados para a semana atual
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $weekAppointments = Appointment::whereBetween('appointment_date', [$startOfWeek, $endOfWeek])->count();

        // Atendimentos agendados para o mês atual
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $monthAppointments = Appointment::whereBetween('appointment_date', [$startOfMonth, $endOfMonth])->count();

        // --- Métricas Financeiras (últimos 30 dias por padrão) ---
        $startPeriod = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endPeriod = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // Receitas de atendimentos concluídos
        $appointmentRevenues = Appointment::whereBetween('appointment_date', [$startPeriod . ' 00:00:00', $endPeriod . ' 23:59:59'])
                                    ->where('status', 'completo')
                                    ->sum('price_charged');

        // Receitas manuais
        $manualRevenues = Revenue::whereBetween('revenue_date', [$startPeriod, $endPeriod])
                            ->sum('amount');

        $totalRevenue = $appointmentRevenues + $manualRevenues;

        // Despesas de pagamentos a profissionais
        $professionalRepasses = ProfessionalPayment::whereBetween('payment_date', [$startPeriod, $endPeriod])
                                            ->whereIn('status', ['pago', 'processando'])
                                            ->sum('total_repass_amount');

        // Despesas manuais
        $manualExpenses = Expense::whereBetween('expense_date', [$startPeriod, $endPeriod])
                                ->sum('amount');

        $totalExpense = $professionalRepasses + $manualExpenses;

        $netBalance = $totalRevenue - $totalExpense;

        return view('admin.dashboard', compact(
            'totalClients',
            'totalProfessionals',
            'todayAppointments',
            'weekAppointments',
            'monthAppointments',
            'totalRevenue',
            'totalExpense',
            'netBalance',
            'startPeriod',
            'endPeriod'
        ));
    }
}