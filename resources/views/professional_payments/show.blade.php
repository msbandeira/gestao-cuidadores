<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Registro de Pagamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('Informações do Pagamento') }}
                            <a href="{{ route('professional_payments.edit', $payment->id) }}" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Editar Status') }}
                            </a>
                        </h3>
                        <p><strong>Profissional:</strong> {{ $payment->professional->full_name }}</p>
                        <p><strong>Período de Atendimentos:</strong> {{ $payment->start_date->format('d/m/Y') }} a {{ $payment->end_date->format('d/m/Y') }}</p>
                        <p><strong>Total de Repasse:</strong> R$ {{ number_format($payment->total_repass_amount, 2, ',', '.') }}</p>
                        <p><strong>Status:</strong>
                            @php
                                $statusClass = '';
                                switch ($payment->status) {
                                    case 'pending': $statusClass = 'bg-yellow-50 text-yellow-700 ring-yellow-600/20'; break;
                                    case 'processing': $statusClass = 'bg-blue-50 text-blue-700 ring-blue-600/20'; break;
                                    case 'paid': $statusClass = 'bg-green-50 text-green-700 ring-green-600/20'; break;
                                    case 'cancelled': $statusClass = 'bg-red-50 text-red-700 ring-red-600/20'; break;
                                }
                            @endphp
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $statusClass }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </p>
                        <p><strong>Data do Pagamento:</strong> {{ $payment->payment_date ? $payment->payment_date->format('d/m/Y') : 'Aguardando' }}</p>
                        <p><strong>Observações:</strong> {{ $payment->notes ?? 'N/A' }}</p>
                        <p><strong>Criado em:</strong> {{ $payment->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('Atendimentos Incluídos neste Pagamento') }}</h3>
                        @if ($payment->appointments->isEmpty())
                            <p>Nenhum atendimento associado a este registro de pagamento.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Atendimento</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plano</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Atendimento</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Repasse</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Atend.</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($payment->appointments as $appointment)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->client->full_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->servicePlan->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $appointment->appointment_date->format('d/m/Y H:i') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">R$ {{ number_format($appointment->professional_repass, 2, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                        {{ ucfirst(str_replace('-', ' ', $appointment->status)) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('professional_payments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para Registros de Pagamento') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>