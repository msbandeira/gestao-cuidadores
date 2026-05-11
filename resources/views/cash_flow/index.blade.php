<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fluxo de Caixa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para Painel Principal') }}
                        </a>
                    <h3 class="font-bold text-lg mb-4">{{ __('Visão Geral do Período') }}</h3>

                    <form method="GET" action="{{ route('cash_flow.index') }}" class="mb-6 bg-gray-50 p-4 rounded-lg shadow-inner">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                            <div>
                                <x-input-label for="start_date" :value="__('Data de Início')" />
                                <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="$startDate" />
                            </div>
                            <div>
                                <x-input-label for="end_date" :value="__('Data de Fim')" />
                                <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="$endDate" />
                            </div>
                            <div class="flex items-end">
                                <x-primary-button>
                                    {{ __('Aplicar Filtro') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
                            <h4 class="text-sm font-semibold mb-2">{{ __('Total de Entradas') }}</h4>
                            <p class="text-3xl font-bold">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
                        </div>
                        <div class="bg-red-500 text-white p-6 rounded-lg shadow-md">
                            <h4 class="text-sm font-semibold mb-2">{{ __('Total de Despesas') }}</h4>
                            <p class="text-3xl font-bold">R$ {{ number_format($totalExpense + $totalProfessionalRepass, 2, ',', '.') }}</p>
                        </div>
                        <div class="p-6 rounded-lg shadow-md {{ $netCashFlow >= 0 ? 'bg-blue-500 text-white' : 'bg-orange-500 text-white' }}">
                            <h4 class="text-sm font-semibold mb-2">{{ __('Saldo Líquido') }}</h4>
                            <p class="text-3xl font-bold">R$ {{ number_format($netCashFlow, 2, ',', '.') }}</p>
                        </div>
                    </div>

                    <hr class="my-6">

                    <h3 class="font-bold text-lg mb-4">{{ __('Detalhes das Transações no Período') }}</h3>

                    @if ($transactions->isEmpty())
                        <p>Nenhuma transação encontrada no período selecionado.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Valor</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->transaction_date->format('d/m/Y') ?? ($transaction->revenue_date->format('d/m/Y') ?? $transaction->expense_date->format('d/m/Y')) }}</td>
                                            <td class="px-6 py-4">{{ $transaction->display_description }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($transaction->type == 'revenue')
                                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Entrada Manual</span>
                                                @elseif ($transaction->type == 'appointment_revenue')
                                                    <span class="inline-flex items-center rounded-full bg-lime-50 px-2 py-1 text-xs font-medium text-lime-700 ring-1 ring-inset ring-lime-600/20">Receita de Atendimento</span>
                                                @elseif ($transaction->type == 'expense')
                                                    <span class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Despesa</span>
                                                @elseif ($transaction->type == 'professional_repass')
                                                    <span class="inline-flex items-center rounded-full bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-600/20">Repasse Profissional</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right @if ($transaction->type == 'revenue' || $transaction->type == 'appointment_revenue') text-green-600 @else text-red-600 @endif">
                                            @if ($transaction->type == 'revenue' || $transaction->type == 'appointment_revenue') 
                                                R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                            @else 
                                                -R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                            @endif
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>