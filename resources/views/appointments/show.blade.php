<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Atendimento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('Informações do Atendimento') }}
                            <a href="{{ route('appointments.edit', $appointment->id) }}" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Editar Atendimento') }}
                            </a>
                        </h3>
                        <p><strong>Cliente:</strong> {{ $appointment->client->full_name }}</p>
                        <p><strong>Profissional:</strong> {{ $appointment->professional->full_name }}</p>
                        <p><strong>Plano de Serviço:</strong> {{ $appointment->servicePlan->name }}</p>
                        <p><strong>Data e Hora:</strong> {{ $appointment->appointment_date->format('d/m/Y H:i') }}</p>
                        <p><strong>Duração:</strong> {{ $appointment->duration_minutes ? $appointment->duration_minutes . ' minutos' : 'N/A' }}</p>
                        <p><strong>Preço Cobrado:</strong> R$ {{ number_format($appointment->price_charged, 2, ',', '.') }}</p>
                        <p><strong>Repasse para Profissional:</strong> R$ {{ number_format($appointment->professional_repass, 2, ',', '.') }}</p>
                        <p><strong>Entrada para Empresa:</strong> R$ {{ number_format($appointment->company_intake, 2, ',', '.') }}</p>
                        <p><strong>Status:</strong>
                            @php
                                $statusClass = '';
                                switch ($appointment->status) {
                                    case 'Agendado': $statusClass = 'bg-blue-50 text-blue-700 ring-blue-600/20'; break;
                                    case 'Completo': $statusClass = 'bg-green-50 text-green-700 ring-green-600/20'; break;
                                    case 'Cancelado': $statusClass = 'bg-red-50 text-red-700 ring-red-600/20'; break;
                                    case 'Agendado-Pago': $statusClass = 'bg-yellow-50 text-yellow-700 ring-yellow-600/20'; break;
                                    case 'no-show': $statusClass = 'bg-gray-50 text-gray-700 ring-gray-600/20'; break;
                                }
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $statusClass }}">
                                {{ ucfirst(str_replace('-', ' ', $appointment->status)) }}
                            </span>
                        </p>
                        <p><strong>Observações:</strong> {{ $appointment->notes ?? 'N/A' }}</p>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para a Lista de Atendimentos') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>