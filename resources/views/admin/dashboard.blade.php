
<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Administrativo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-8 p-4 bg-gray-50 rounded-lg shadow-inner">
                    <h3 class="font-semibold text-lg mb-2 text-gray-700">Filtro de Período Financeiro</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <x-input-label for="start_date" :value="__('Data de Início')" />
                            <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="$startPeriod" />
                        </div>
                        <div>
                            <x-input-label for="end_date" :value="__('Data de Fim')" />
                            <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="$endPeriod" />
                        </div>
                        <div class="flex items-end">
                            <x-primary-button>
                                {{ __('Aplicar Filtro') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-indigo-500 text-white p-6 rounded-lg shadow-md flex flex-col justify-center items-center">
                        <div class="text-lg font-bold">Total de Clientes</div>
                        <div class="text-4xl font-bold mt-2">{{ $totalClients }}</div>
                    </div>

                    <div class="bg-teal-500 text-white p-6 rounded-lg shadow-md flex flex-col justify-center items-center">
                        <div class="text-lg font-bold">Total de Profissionais</div>
                        <div class="text-4xl font-bold mt-2">{{ $totalProfessionals }}</div>
                    </div>

                    <div class="bg-gray-700 text-white p-6 rounded-lg shadow-md flex flex-col justify-center items-center">
                        <div class="text-lg font-bold">Atendimentos Hoje</div>
                        <div class="text-4xl font-bold mt-2">{{ $todayAppointments }}</div>
                    </div>
                    
                    <div class="bg-gray-700 text-white p-6 rounded-lg shadow-md flex flex-col justify-center items-center">
                        <div class="text-lg font-bold">Atendimentos no Mês</div>
                        <div class="text-4xl font-bold mt-2">{{ $monthAppointments }}</div>
                    </div>
                </div>

                <h3 class="font-semibold text-lg mb-4 text-gray-700">Resumo Financeiro (Período: {{ date('d/m/Y', strtotime($startPeriod)) }} a {{ date('d/m/Y', strtotime($endPeriod)) }})</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
                        <h4 class="text-sm font-semibold mb-2">Receita Total</h4>
                        <p class="text-3xl font-bold">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
                    </div>

                    <div class="bg-red-500 text-white p-6 rounded-lg shadow-md">
                        <h4 class="text-sm font-semibold mb-2">Despesas Totais</h4>
                        <p class="text-3xl font-bold">R$ {{ number_format($totalExpense, 2, ',', '.') }}</p>
                    </div>

                    <div class="p-6 rounded-lg shadow-md {{ $netBalance >= 0 ? 'bg-blue-500 text-white' : 'bg-orange-500 text-white' }}">
                        <h4 class="text-sm font-semibold mb-2">Saldo Líquido</h4>
                        <p class="text-3xl font-bold">R$ {{ number_format($netBalance, 2, ',', '.') }}</p>
                    </div>
                </div>
                    <div class="mt-6">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para Painel Principal') }}
                        </a>
                    </div>
                </div>
        </div>
        
    </div>
</x-app-layout>