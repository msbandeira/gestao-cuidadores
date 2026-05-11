<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalPayment;
use App\Models\Professional;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfessionalPaymentController extends Controller
{
    // Exibe a lista de todos os registros de pagamentos
    public function index()
    {
        $payments = ProfessionalPayment::with('professional')->orderBy('created_at', 'desc')->get();
        return view('professional_payments.index', compact('payments'));
    }

    // Exibe o formulário para gerar um novo registro de pagamento
    public function create()
    {
        // O campo de seleção do profissional foi removido, então não precisamos mais carregar a lista.
        return view('professional_payments.create');
    }

    // Gera e armazena um novo registro de pagamento com base nos atendimentos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'notes' => 'nullable|string|max:1000',
        ]);

        $startDate = $validatedData['start_date'];
        $endDate = $validatedData['end_date'];

        // 1. Encontrar todos os atendimentos elegíveis no período
        $appointments = Appointment::whereBetween('appointment_date', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                                   ->whereNull('professional_payment_id') // Apenas atendimentos ainda não pagos
                                   ->whereIn('status', ['completo']) // Apenas atendimentos concluídos que geram repasse
                                   ->get();

        if ($appointments->isEmpty()) {
            return redirect()->back()->withErrors(['Não há atendimentos elegíveis para este período.'])
                             ->withInput();
        }

        // 2. Agrupar os atendimentos por profissional
        $appointmentsByProfessional = $appointments->groupBy('professional_id');

        DB::beginTransaction();

        try {
            // 3. Iterar sobre cada profissional e criar um registro de pagamento
            foreach ($appointmentsByProfessional as $professionalId => $professionalAppointments) {
                // Calcular o total de repasse para o profissional atual
                $totalRepassAmount = $professionalAppointments->sum('professional_repass');

                // 4. Criar o registro de pagamento
                $payment = ProfessionalPayment::create([
                    'professional_id' => $professionalId,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'total_repass_amount' => $totalRepassAmount,
                    'status' => 'pendente',
                    'notes' => $validatedData['notes'],
                ]);

                // 5. Vincular os atendimentos a este registro de pagamento
                foreach ($professionalAppointments as $appointment) {
                    $appointment->professional_payment_id = $payment->id;
                    $appointment->save();
                }
            }

            DB::commit();

            return redirect()->route('professional_payments.index')
                             ->with('success', 'Registros de pagamento gerados com sucesso para todos os profissionais elegíveis!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error for debugging
            \Log::error('Erro ao gerar registros de pagamento: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Ocorreu um erro ao gerar os registros de pagamento. Por favor, tente novamente.'])
                             ->withInput();
        }
    }

    // Restante do código do controller não precisa de alteração
    public function show(ProfessionalPayment $payment)
    {
        $payment->load(['professional', 'appointments.client', 'appointments.servicePlan']);
        return view('professional_payments.show', compact('payment'));
    }

    public function edit(ProfessionalPayment $payment)
    {
        $payment->load('professional');
        return view('professional_payments.edit', compact('payment'));
    }

    public function update(Request $request, ProfessionalPayment $payment)
    {
        $validatedData = $request->validate([
            'status' => 'required|string|in:pendente,processando,pago,cancelado',
            'payment_date' => 'nullable|date|before_or_equal:today',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validatedData['status'] === 'pago' && empty($validatedData['payment_date'])) {
            return redirect()->back()->withErrors(['A data de pagamento é obrigatória para o status "Pago".'])->withInput();
        }

        if ($validatedData['status'] !== 'pago') {
            $validatedData['payment_date'] = null;
        }

        $payment->update($validatedData);

        return redirect()->route('professional_payments.show', $payment->id)
                         ->with('success', 'Status do pagamento atualizado com sucesso!');
    }

    public function destroy(ProfessionalPayment $payment)
    {
        $payment->delete();
        return redirect()->route('professional_payments.index')
                         ->with('success', 'Registro de pagamento excluído com sucesso!');
    }
}