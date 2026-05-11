<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Child; // Importe o modelo Child
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Para validação manual se necessário
use Illuminate\Validation\Rule; // Para regras de validação

class ClientController extends Controller
{
    // Método para exibir a lista de clientes (será desenvolvido mais tarde)
    public function index(Request $request)
    {
        $query = Client::query();

        // Se houver um termo de busca, filtra por CPF
        if ($request->filled('search')) {
            $query->where('cpf', 'like', '%' . $request->search . '%');
        }

        // Ordena e pega os clientes
        $clients = $query->orderBy('full_name')->get();

        return view('clients.index', compact('clients'));
    }

    // Método para exibir o formulário de cadastro de novo cliente
    public function create()
    {
        return view('clients.create');
    }

    // Método para armazenar os dados do novo cliente
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:clients,email',
            'cpf' => 'required|string|max:14|unique:clients,cpf', // CPF pode ter máscara
            'address' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        $client = Client::create($request->all());

        // Redireciona para o formulário de cadastro de filho com o ID do cliente
        return redirect()->route('children.create', $client->id)
                         ->with('success', 'Cliente cadastrado com sucesso! Agora, adicione os filhos.');
    }

    // Método para exibir o formulário de cadastro de filho para um cliente específico
    public function createChild(Client $client)
    {
        return view('clients.children.create', compact('client'));
    }

    // Método para armazenar os dados do filho
    public function storeChild(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0|max:150',
            'gender' => 'nullable|string|max:50',
            'diagnosis' => 'nullable|string|max:255',
            'tea_level' => ['nullable', Rule::in(['Nível 1', 'Nível 2', 'Nível 3'])],
            'associated_conditions' => 'nullable|string|max:500',
            'is_verbal' => 'nullable|boolean',
            'toilet_autonomy' => ['nullable', Rule::in(['Sim', 'Não', 'Com ajuda'])],
            'feeding_autonomy' => ['nullable', Rule::in(['Sim', 'Não', 'Com ajuda'])],
            'hygiene_autonomy' => ['nullable', Rule::in(['Sim', 'Não', 'Com ajuda'])],
            'aggression_behavior' => ['nullable', Rule::in(['Sim', 'Não', 'Raros'])],
            'routine_rigidity' => 'nullable|boolean',
            'main_difficulties' => 'nullable|string|max:1000',
            'calming_strategies' => 'nullable|string|max:1000',
            'babysitter_tasks' => 'nullable|array', // Validar como array de strings se quiser
            'babysitter_tasks.*' => 'nullable|string|max:255',
            'ideal_babysitter_profile' => 'nullable|string|max:1000',
            'babysitter_age_preference' => 'nullable|string|max:50',
            'babysitter_gender_preference' => 'nullable|string|max:50',
            'babysitter_formation_experience' => 'nullable|string|max:1000',
            'babysitter_other_preferences' => 'nullable|string|max:1000',
            'desired_hours' => 'nullable|array',
            'desired_hours.*' => ['nullable', Rule::in(['Manhã', 'Tarde', 'Noite', 'Finais de semana'])],
            'available_days_of_week' => 'nullable|string|max:255',
            'residence_neighborhood' => 'nullable|string|max:255',
            'residence_city' => 'nullable|string|max:255',
            'has_pet' => 'nullable|boolean',
            'easy_public_transport' => 'nullable|boolean',
        ]);

        // Se as checkboxes não vierem no request, ensure que os campos são tratados corretamente
        $validatedData['babysitter_tasks'] = $validatedData['babysitter_tasks'] ?? [];
        $validatedData['desired_hours'] = $validatedData['desired_hours'] ?? [];

        $client->children()->create($validatedData);

        return redirect()->route('clients.show', $client->id)
                         ->with('success', 'Filho(a) cadastrado(a) com sucesso!');
        // Ou, se quiser permitir adicionar mais de um filho, pode redirecionar novamente para o createChild
        // return redirect()->route('children.create', $client->id)->with('success', 'Filho(a) cadastrado(a)! Adicione outro ou finalize.');
    }

    // Método para exibir os detalhes de um cliente e seus filhos (será desenvolvido)
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    // Métodos edit, update, destroy serão adicionados posteriormente.
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Método para atualizar os dados de um cliente
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:clients,email,' . $client->id, // Ignora o email do próprio cliente
            'cpf' => 'required|string|max:14|unique:clients,cpf,' . $client->id, // Ignora o CPF do próprio cliente
            'address' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.show', $client->id)
                         ->with('success', 'Dados do cliente atualizados com sucesso!');
    }

    // Método para exibir o formulário de edição de um filho
    public function editChild(Client $client, Child $child)
    {
        // Certifica-se de que o filho pertence a este cliente
        if ($child->client_id !== $client->id) {
            abort(404); // Ou redirecionar com erro
        }
        return view('clients.children.edit', compact('client', 'child'));
    }

    // Método para atualizar os dados de um filho
    public function updateChild(Request $request, Client $client, Child $child)
    {
        // Certifica-se de que o filho pertence a este cliente
        if ($child->client_id !== $client->id) {
            abort(404); // Ou redirecionar com erro
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0|max:150',
            'gender' => 'nullable|string|max:50',
            'diagnosis' => 'nullable|string|max:255',
            'tea_level' => ['nullable', Rule::in(['Nível 1', 'Nível 2', 'Nível 3'])],
            'associated_conditions' => 'nullable|string|max:500',
            'is_verbal' => 'nullable|boolean',
            'toilet_autonomy' => ['nullable', Rule::in(['Sim', 'Não', 'Com ajuda'])],
            'feeding_autonomy' => ['nullable', Rule::in(['Sim', 'Não', 'Com ajuda'])],
            'hygiene_autonomy' => ['nullable', Rule::in(['Sim', 'Não', 'Com ajuda'])],
            'aggression_behavior' => ['nullable', Rule::in(['Sim', 'Não', 'Raros'])],
            'routine_rigidity' => 'nullable|boolean',
            'main_difficulties' => 'nullable|string|max:1000',
            'calming_strategies' => 'nullable|string|max:1000',
            'babysitter_tasks' => 'nullable|array',
            'babysitter_tasks.*' => 'nullable|string|max:255',
            'ideal_babysitter_profile' => 'nullable|string|max:1000',
            'babysitter_age_preference' => 'nullable|string|max:50',
            'babysitter_gender_preference' => 'nullable|string|max:50',
            'babysitter_formation_experience' => 'nullable|string|max:1000',
            'babysitter_other_preferences' => 'nullable|string|max:1000',
            'desired_hours' => 'nullable|array',
            'desired_hours.*' => ['nullable', Rule::in(['Manhã', 'Tarde', 'Noite', 'Finais de semana'])],
            'available_days_of_week' => 'nullable|string|max:255',
            'residence_neighborhood' => 'nullable|string|max:255',
            'residence_city' => 'nullable|string|max:255',
            'has_pet' => 'nullable|boolean',
            'easy_public_transport' => 'nullable|boolean',
        ]);

        // Trata checkboxes que não foram marcadas (não vêm no request)
        $validatedData['babysitter_tasks'] = $validatedData['babysitter_tasks'] ?? [];
        $validatedData['desired_hours'] = $validatedData['desired_hours'] ?? [];
        $validatedData['is_verbal'] = $validatedData['is_verbal'] ?? 0; // Se não marcado, assume 0 (Não)
        $validatedData['routine_rigidity'] = $validatedData['routine_rigidity'] ?? 0;
        $validatedData['has_pet'] = $validatedData['has_pet'] ?? 0;
        $validatedData['easy_public_transport'] = $validatedData['easy_public_transport'] ?? 0;


        $child->update($validatedData);

        return redirect()->route('clients.show', $client->id)
                         ->with('success', 'Dados do filho(a) atualizados com sucesso!');
    }
}