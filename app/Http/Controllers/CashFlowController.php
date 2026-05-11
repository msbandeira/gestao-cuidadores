<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use App\Models\Expense;
use App\Models\ProfessionalPayment;
use App\Models\Appointment; // Importar o modelo Appointment
use Illuminate\Http\Request;
use Carbon\Carbon;

class CashFlowController extends Controller
{
    public function index(Request $request)
    {
        // Define o período padrão (últimos 30 dias)
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // Consulta as receitas manuais no período
        $manualRevenues = Revenue::whereBetween('revenue_date', [$startDate, $endDate])
                            ->orderBy('revenue_date', 'asc')
                            ->get();

        // Consulta os atendimentos concluídos para a 'company_intake'
        // Consideramos que o 'company_intake' é a receita real do atendimento para a empresa
        $appointmentRevenues = Appointment::whereBetween('appointment_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                                        ->where('status', 'completo') // Apenas atendimentos concluídos
                                        ->orderBy('appointment_date', 'asc')
                                        ->get();

        // Consulta as despesas (cadastradas manualmente) no período
        $expenses = Expense::whereBetween('expense_date', [$startDate, $endDate])
                            ->orderBy('expense_date', 'asc')
                            ->get();

        // Considera os pagamentos de repasse a profissionais como despesas
        // Filtra apenas os pagamentos com status 'paid' (ou 'processing' se quiser incluir os previstos para sair)
        $professionalPayments = ProfessionalPayment::whereBetween('payment_date', [$startDate, $endDate])
                                                    ->whereIn('status', ['pago', 'processando'])
                                                    ->orderBy('payment_date', 'asc')
                                                    ->get();

        // Calcula os totais
        $totalManualRevenue = $manualRevenues->sum('amount');
        $totalAppointmentRevenue = $appointmentRevenues->sum('price_charged'); // Soma a parte da empresa dos atendimentos

        $totalRevenue = $totalManualRevenue + $totalAppointmentRevenue; // Total geral de entradas

        $totalExpense = $expenses->sum('amount');
        $totalProfessionalRepass = $professionalPayments->sum('total_repass_amount');

        $netCashFlow = $totalRevenue - ($totalExpense + $totalProfessionalRepass);

        // Combina todas as transações para exibição
        $transactions = collect()
            // Mapeia receitas manuais
            ->merge($manualRevenues->map(function ($item) {
                $item->type = 'revenue';
                $item->transaction_date = $item->revenue_date;
                $item->display_description = $item->description;
                return $item;
            }))
            // Mapeia receitas de atendimentos (company_intake)
            ->merge($appointmentRevenues->map(function ($item) {
                $item->type = 'appointment_revenue'; // Novo tipo para diferenciar
                $item->transaction_date = $item->appointment_date;
                $item->amount = $item->company_intake; // O valor da entrada é o company_intake
                $item->display_description = 'Receita Atendimento: ' . $item->client->name . ' (' . $item->servicePlan->name . ')';
                return $item;
            }))
            // Mapeia despesas
            ->merge($expenses->map(function ($item) {
                $item->type = 'expense';
                $item->transaction_date = $item->expense_date;
                $item->display_description = $item->description;
                return $item;
            }))
            // Mapeia pagamentos de profissionais
            ->merge($professionalPayments->map(function ($item) {
                $item->type = 'professional_repass';
                $item->display_description = 'Repasse Profissional: ' . $item->professional->name . ' (Período: ' . $item->start_date->format('d/m/Y') . ' - ' . $item->end_date->format('d/m/Y') . ')';
                $item->amount = $item->total_repass_amount;
                $item->transaction_date = $item->payment_date;
                return $item;
            }))
            ->sortBy('transaction_date'); // Ordena por data da transação

        return view('cash_flow.index', compact(
            'startDate',
            'endDate',
            'totalRevenue', // Total combinado
            'totalExpense',
            'totalProfessionalRepass',
            'netCashFlow',
            'transactions'
        ));
    }
}