<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Plano de Serviço: ') }}<span class="text-indigo-600">{{ $servicePlan->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('Informações do Plano') }}
                            <a href="{{ route('service_plans.edit', $servicePlan->id) }}" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Editar Plano') }}
                            </a>
                        </h3>
                        <p><strong>Nome do Plano:</strong> {{ $servicePlan->name }}</p>
                        <p><strong>Descrição:</strong> {{ $servicePlan->description ?? 'N/A' }}</p>
                        <p><strong>Preço Total:</strong> R$ {{ number_format($servicePlan->price, 2, ',', '.') }}</p>
                        <p><strong>Repasse para Profissional:</strong> R$ {{ number_format($servicePlan->professional_repass_value, 2, ',', '.') }}</p>
                        <p><strong>Entrada para Empresa:</strong> R$ {{ number_format($servicePlan->company_intake_value, 2, ',', '.') }}</p>
                        <p><strong>Tipo de Plano:</strong> {{ $servicePlan->plan_type ?? 'N/A' }}</p>
                        <p><strong>Horas Incluídas:</strong> {{ $servicePlan->hours_included ?? 'N/A' }}</p>
                        <p><strong>Validade em Dias:</strong> {{ $servicePlan->days_validity ?? 'N/A' }}</p>
                        <p><strong>Ativo:</strong>
                            @if ($servicePlan->is_active)
                                <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Sim</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Não</span>
                            @endif
                        </p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('Benefícios') }}</h3>
                        @if ($servicePlan->benefits)
                            <ul class="list-disc list-inside">
                                @foreach ($servicePlan->benefits as $benefit)
                                    <li>{{ $benefit }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Nenhum benefício listado.</p>
                        @endif
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('Restrições') }}</h3>
                        @if ($servicePlan->restrictions)
                            <ul class="list-disc list-inside">
                                @foreach ($servicePlan->restrictions as $restriction)
                                    <li>{{ $restriction }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Nenhuma restrição listada.</p>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('service_plans.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para a Lista de Planos') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>