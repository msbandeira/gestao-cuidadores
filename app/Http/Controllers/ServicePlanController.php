<?php

namespace App\Http\Controllers;

use App\Models\ServicePlan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServicePlanController extends Controller
{
    // Método para exibir a lista de planos de serviço
    public function index()
    {
        $servicePlans = ServicePlan::all();
        return view('service_plans.index', compact('servicePlans'));
    }

    // Método para exibir o formulário de cadastro de novo plano
    public function create()
    {
        return view('service_plans.create');
    }

    // Método para armazenar os dados do novo plano
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:service_plans,name',
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'professional_repass_value' => 'nullable|numeric|min:0|lte:price', // Repasse não pode ser maior que o preço
            'company_intake_value' => 'nullable|numeric|min:0',
            'plan_type' => 'nullable|string|max:255',
            'hours_included' => 'nullable|integer|min:0',
            'days_validity' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'benefits' => 'nullable|array',
            'benefits.*' => 'nullable|string|max:255',
            'restrictions' => 'nullable|array',
            'restrictions.*' => 'nullable|string|max:255',
        ]);

        // Trata checkboxes e campos que podem vir vazios
        $validatedData['is_active'] = $request->has('is_active');
        $validatedData['benefits'] = $validatedData['benefits'] ?? [];
        $validatedData['restrictions'] = $validatedData['restrictions'] ?? [];

        // Verifica se a soma dos valores de repasse e entrada é igual ao preço
        if (isset($validatedData['professional_repass_value']) && isset($validatedData['company_intake_value'])) {
            $sumOfValues = (float) $validatedData['professional_repass_value'] + (float) $validatedData['company_intake_value'];
            if (abs($sumOfValues - (float) $validatedData['price']) > 0.001) { // Usar tolerância para float
                return redirect()->back()->withErrors(['A soma do valor de repasse e entrada deve ser igual ao preço do plano.'])->withInput();
            }
        }

        ServicePlan::create($validatedData);

        return redirect()->route('service_plans.index')
                         ->with('success', 'Plano de serviço cadastrado com sucesso!');
    }

    // Método para exibir os detalhes de um plano
    public function show(ServicePlan $servicePlan)
    {
        return view('service_plans.show', compact('servicePlan'));
    }

    // Método para exibir o formulário de edição de um plano
    public function edit(ServicePlan $servicePlan)
    {
        return view('service_plans.edit', compact('servicePlan'));
    }

    // Método para atualizar os dados de um plano
    public function update(Request $request, ServicePlan $servicePlan)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:service_plans,name,' . $servicePlan->id,
            'description' => 'nullable|string|max:1000',
            'price' => 'required|numeric|min:0',
            'professional_repass_value' => 'nullable|numeric|min:0|lte:price',
            'company_intake_value' => 'nullable|numeric|min:0',
            'plan_type' => 'nullable|string|max:255',
            'hours_included' => 'nullable|integer|min:0',
            'days_validity' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'benefits' => 'nullable|array',
            'benefits.*' => 'nullable|string|max:255',
            'restrictions' => 'nullable|array',
            'restrictions.*' => 'nullable|string|max:255',
        ]);

        // Trata checkboxes e campos que podem vir vazios
        $validatedData['is_active'] = $request->has('is_active');
        $validatedData['benefits'] = $validatedData['benefits'] ?? [];
        $validatedData['restrictions'] = $validatedData['restrictions'] ?? [];

        // Verifica se a soma dos valores de repasse e entrada é igual ao preço
        if (isset($validatedData['professional_repass_value']) && isset($validatedData['company_intake_value'])) {
            $sumOfValues = (float) $validatedData['professional_repass_value'] + (float) $validatedData['company_intake_value'];
            if (abs($sumOfValues - (float) $validatedData['price']) > 0.001) {
                return redirect()->back()->withErrors(['A soma do valor de repasse e entrada deve ser igual ao preço do plano.'])->withInput();
            }
        }

        $servicePlan->update($validatedData);

        return redirect()->route('service_plans.show', $servicePlan->id)
                         ->with('success', 'Plano de serviço atualizado com sucesso!');
    }

    // Método para excluir um plano (opcional, adicionar depois se necessário)
    public function destroy(ServicePlan $servicePlan)
    {
        $servicePlan->delete();
        return redirect()->route('service_plans.index')
                         ->with('success', 'Plano de serviço excluído com sucesso!');
    }
}