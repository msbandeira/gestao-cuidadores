<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfessionalController extends Controller
{
    // Método para exibir a lista de profissionais
    public function index(Request $request)
    {
        $query = Professional::query();

        // Filtro por especialidades
        if ($request->filled('specialties')) {
            $specialties = $request->input('specialties');
            $query->where(function ($q) use ($specialties) {
                foreach ($specialties as $specialty) {
                    $q->orWhere('specialties', 'like', "%{$specialty}%");
                }
            });
        }

        // Filtro por disponibilidade (dias da semana)
        if ($request->filled('availability')) {
            $availability = $request->input('availability');
            $query->where(function ($q) use ($availability) {
                foreach ($availability as $day) {
                    $q->orWhere('available_hours', 'like', "%{$day}%");
                }
            });
        }

        // Filtro por nivel do TEA
        if ($request->filled('levels')) {
            $levels = $request->input('levels');
            $query->where(function ($q) use ($levels) {
                foreach ($levels as $tea) {
                    $q->orWhere('tea_level', 'like', "%{$tea}%");
                }
            });
        }

        // Pega os profissionais ordenados pelo nome
        $professionals = $query->orderBy('full_name')->get();

        return view('professionals.index', compact('professionals'));
    }

    // Método para exibir o formulário de cadastro de novo profissional
    public function create()
    {
        return view('professionals.create');
    }

    // Método para armazenar os dados do novo profissional
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:professionals,email',
            'cpf' => 'required|string|max:14|unique:professionals,cpf',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'education_level' => 'nullable|string|max:255',
            'relevant_courses' => 'nullable|string|max:1000',
            'experience_description' => 'nullable|string|max:2000',
            'experience_years' => 'nullable|string|max:255',
            'specialties' => 'nullable|array',
            'specialties.*' => 'nullable|string|max:255',
            'available_hours' => 'nullable|array',
            'available_hours.*' => ['nullable', Rule::in(['Manhã', 'Tarde', 'Noite', 'Finais de semana'])],
            'available_days_of_week' => 'nullable|string|max:255',
            'accepts_pets' => 'nullable|boolean',
            'has_own_transport' => 'nullable|boolean',
            'transport_details' => 'nullable|string|max:255',
            'preferred_regions' => 'nullable|string|max:500',
            'tea_level' => ['nullable', Rule::in(['Nível 1', 'Nível 2', 'Nível 3'])],
            'personal_description' => 'nullable|string|max:2000',
            'communication_style' => 'nullable|string|max:500',
            'calming_strategies_knowledge' => 'nullable|string|max:1000',
            'first_aid_training' => 'nullable|boolean',
            'has_cnh' => 'nullable|boolean',
            'smoker' => 'nullable|boolean',
            'religion' => 'nullable|string|max:255',
            'spoken_languages' => 'nullable|string|max:255',
            
        ]);

        // Trata checkboxes que não foram marcadas (não vêm no request)
        $validatedData['specialties'] = $validatedData['specialties'] ?? [];
        $validatedData['available_hours'] = $validatedData['available_hours'] ?? [];
        $validatedData['accepts_pets'] = $validatedData['accepts_pets'] ?? 0;
        $validatedData['has_own_transport'] = $validatedData['has_own_transport'] ?? 0;
        $validatedData['first_aid_training'] = $validatedData['first_aid_training'] ?? 0;
        $validatedData['has_cnh'] = $validatedData['has_cnh'] ?? 0;
        $validatedData['smoker'] = $validatedData['smoker'] ?? 0;

        Professional::create($validatedData);

        return redirect()->route('professionals.index')
                         ->with('success', 'Profissional cadastrado com sucesso!');
    }

    // Método para exibir os detalhes de um profissional
    public function show(Professional $professional)
    {
        return view('professionals.show', compact('professional'));
    }

    // Método para exibir o formulário de edição de um profissional
    public function edit(Professional $professional)
    {
        return view('professionals.edit', compact('professional'));
    }

    // Método para atualizar os dados de um profissional
    public function update(Request $request, Professional $professional)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:professionals,email,' . $professional->id,
            'cpf' => 'required|string|max:14|unique:professionals,cpf,' . $professional->id,
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'education_level' => 'nullable|string|max:255',
            'relevant_courses' => 'nullable|string|max:1000',
            'experience_description' => 'nullable|string|max:2000',
            'experience_years' => 'nullable|string|max:255',
            'specialties' => 'nullable|array',
            'specialties.*' => 'nullable|string|max:255',
            'available_hours' => 'nullable|array',
            'available_hours.*' => ['nullable', Rule::in(['Manhã', 'Tarde', 'Noite', 'Finais de semana'])],
            'available_days_of_week' => 'nullable|string|max:255',
            'accepts_pets' => 'nullable|boolean',
            'has_own_transport' => 'nullable|boolean',
            'transport_details' => 'nullable|string|max:255',
            'preferred_regions' => 'nullable|string|max:500',
            'tea_level' => ['nullable', Rule::in(['Nível 1', 'Nível 2', 'Nível 3'])],
            'personal_description' => 'nullable|string|max:2000',
            'communication_style' => 'nullable|string|max:500',
            'calming_strategies_knowledge' => 'nullable|string|max:1000',
            'first_aid_training' => 'nullable|boolean',
            'has_cnh' => 'nullable|boolean',
            'smoker' => 'nullable|boolean',
            'religion' => 'nullable|string|max:255',
            'spoken_languages' => 'nullable|string|max:255',
        ]);

        // Trata checkboxes que não foram marcadas (não vêm no request)
        $validatedData['specialties'] = $validatedData['specialties'] ?? [];
        $validatedData['available_hours'] = $validatedData['available_hours'] ?? [];
        $validatedData['accepts_pets'] = $validatedData['accepts_pets'] ?? 0;
        $validatedData['has_own_transport'] = $validatedData['has_own_transport'] ?? 0;
        $validatedData['first_aid_training'] = $validatedData['first_aid_training'] ?? 0;
        $validatedData['has_cnh'] = $validatedData['has_cnh'] ?? 0;
        $validatedData['smoker'] = $validatedData['smoker'] ?? 0;

        $professional->update($validatedData);

        return redirect()->route('professionals.show', $professional->id)
                         ->with('success', 'Dados do profissional atualizados com sucesso!');
    }

    // Método para excluir um profissional (opcional, adicionar depois se necessário)
    // public function destroy(Professional $professional)
    // {
    //     $professional->delete();
    //     return redirect()->route('professionals.index')
    //                      ->with('success', 'Profissional excluído com sucesso!');
    // }
}