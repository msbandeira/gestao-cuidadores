<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Professional;
use App\Models\ServicePlan;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Método para exibir a lista de atendimentos
    public function index()
    {
        $appointments = Appointment::with(['client', 'professional', 'servicePlan'])->orderBy('appointment_date', 'desc')->get();
        return view('appointments.index', compact('appointments'));
    }

    // Método para exibir o formulário de registro de novo atendimento
    public function create()
    {
        $clients = Client::orderBy('full_name')->get();
        $professionals = Professional::orderBy('full_name')->get();
        $servicePlans = ServicePlan::where('is_active', true)->orderBy('name')->get(); // Apenas planos ativos
        return view('appointments.create', compact('clients', 'professionals', 'servicePlans'));
    }

    // Método para armazenar os dados do novo atendimento
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'professional_id' => 'required|exists:professionals,id',
            'service_plan_id' => 'required|exists:service_plans,id',
            'appointment_date' => 'required|date',
            'duration_minutes' => 'nullable|integer|min:10',
            'price_charged' => 'required|numeric|min:0',
            'professional_repass' => 'nullable|numeric|min:0|lte:price_charged',
            'company_intake' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:Agendado,Completo,Cancelado,Agendado-Pago,Não-Compareceu',
            'notes' => 'nullable|string|max:1000',
        ]);

        $servicePlan = ServicePlan::findOrFail($validatedData['service_plan_id']);

        // Se professional_repass e company_intake não forem fornecidos, use os valores do plano
        $validatedData['professional_repass'] = $validatedData['professional_repass'] ?? $servicePlan->professional_repass_value;
        $validatedData['company_intake'] = $validatedData['company_intake'] ?? $servicePlan->company_intake_value;

        // Validação de soma de repasse e entrada vs preço cobrado
        $sumOfValues = (float) $validatedData['professional_repass'] + (float) $validatedData['company_intake'];
        if (abs($sumOfValues - (float) $validatedData['price_charged']) > 0.001) {
            return redirect()->back()->withErrors(['A soma do repasse do profissional e da entrada da empresa deve ser igual ao preço cobrado.'])->withInput();
        }

        Appointment::create($validatedData);

        return redirect()->route('appointments.index')
                         ->with('success', 'Atendimento registrado com sucesso!');
    }

    // Método para exibir os detalhes de um atendimento
    public function show(Appointment $appointment)
    {
        $appointment->load(['client', 'professional', 'servicePlan']);
        return view('appointments.show', compact('appointment'));
    }

    // Método para exibir o formulário de edição de um atendimento
    public function edit(Appointment $appointment)
    {
        $clients = Client::orderBy('full_name')->get();
        $professionals = Professional::orderBy('full_name')->get();
        $servicePlans = ServicePlan::where('is_active', true)->orderBy('name')->get();
        return view('appointments.edit', compact('appointment', 'clients', 'professionals', 'servicePlans'));
    }

    // Método para atualizar os dados de um atendimento
    public function update(Request $request, Appointment $appointment)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'professional_id' => 'required|exists:professionals,id',
            'service_plan_id' => 'required|exists:service_plans,id',
            'appointment_date' => 'required|date',
            'duration_minutes' => 'nullable|integer|min:10',
            'price_charged' => 'required|numeric|min:0',
            'professional_repass' => 'nullable|numeric|min:0|lte:price_charged',
            'company_intake' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:Agendado,Completo,Cancelado,Agendado-Pago,Não-Compareceu',
            'notes' => 'nullable|string|max:1000',
        ]);

        $servicePlan = ServicePlan::findOrFail($validatedData['service_plan_id']);

        // Se professional_repass e company_intake não forem fornecidos, use os valores do plano
        $validatedData['professional_repass'] = $validatedData['professional_repass'] ?? $servicePlan->professional_repass_value;
        $validatedData['company_intake'] = $validatedData['company_intake'] ?? $servicePlan->company_intake_value;

        // Validação de soma de repasse e entrada vs preço cobrado
        $sumOfValues = (float) $validatedData['professional_repass'] + (float) $validatedData['company_intake'];
        if (abs($sumOfValues - (float) $validatedData['price_charged']) > 0.001) {
            return redirect()->back()->withErrors(['A soma do repasse do profissional e da entrada da empresa deve ser igual ao preço cobrado.'])->withInput();
        }

        $appointment->update($validatedData);

        return redirect()->route('appointments.show', $appointment->id)
                         ->with('success', 'Atendimento atualizado com sucesso!');
    }

    // Método para excluir um atendimento
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')
                         ->with('success', 'Atendimento excluído com sucesso!');
    }
}