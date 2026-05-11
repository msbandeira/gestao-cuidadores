<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BankAccountController extends Controller
{
    // Exibe o formulário para criar ou editar a conta bancária de um profissional
    public function edit(Professional $professional)
    {
        $bankAccount = $professional->bankAccount; // Tenta carregar a conta existente

        // Passa o profissional e a conta bancária (pode ser null se não existir) para a view
        return view('bank_accounts.edit', compact('professional', 'bankAccount'));
    }

    // Armazena ou atualiza os dados bancários de um profissional
    public function update(Request $request, Professional $professional)
    {
        $validatedData = $request->validate([
            'bank_name' => 'required|string|max:255',
            'agency' => 'required|string|max:50',
            'account_number' => 'required|string|max:100',
            'account_type' => 'nullable|string|max:50',
            'pix_key' => 'nullable|string|max:255',
        ]);

        // Encontra a conta bancária existente ou cria uma nova
        $bankAccount = $professional->bankAccount()->firstOrNew([]);

        // Preenche os dados e associa ao profissional
        $bankAccount->fill($validatedData);
        $bankAccount->professional()->associate($professional);
        $bankAccount->save();

        return redirect()->route('professionals.show', $professional->id)
                         ->with('success', 'Dados bancários do profissional atualizados com sucesso!');
    }

    // Método para excluir os dados bancários de um profissional
    public function destroy(Professional $professional)
    {
        if ($professional->bankAccount) {
            $professional->bankAccount->delete();
            return redirect()->route('professionals.show', $professional->id)
                             ->with('success', 'Dados bancários do profissional removidos com sucesso!');
        }

        return redirect()->route('professionals.show', $professional->id)
                         ->with('error', 'Nenhum dado bancário para remover.');
    }
}