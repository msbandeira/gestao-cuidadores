<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registros de Pagamento de Profissionais') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('professional_payments.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Gerar Novo Pagamento') }}
                        </a>
                        
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para Painel Principal') }}
                        </a>
                    
                    </div>
                    

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($payments->isEmpty())
                        <p>Nenhum registro de pagamento gerado ainda.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profissional</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Período</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Repasse</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Pagamento</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $payment->professional->full_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $payment->start_date->format('d/m/Y') }} - {{ $payment->end_date->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">R$ {{ number_format($payment->total_repass_amount, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusClass = '';
                                                    switch ($payment->status) {
                                                        case 'pendente': $statusClass = 'bg-yellow-50 text-yellow-700 ring-yellow-600/20'; break;
                                                        case 'processando': $statusClass = 'bg-blue-50 text-blue-700 ring-blue-600/20'; break;
                                                        case 'pago': $statusClass = 'bg-green-50 text-green-700 ring-green-600/20'; break;
                                                        case 'cancelado': $statusClass = 'bg-red-50 text-red-700 ring-red-600/20'; break;
                                                    }
                                                @endphp
                                                <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $statusClass }}">
                                                    {{ ucfirst($payment->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y') : 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('professional_payments.show', $payment->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Ver Detalhes</a>
                                                <a href="{{ route('professional_payments.edit', $payment->id) }}" class="text-blue-600 hover:text-blue-900 mr-4">Editar Status</a>
                                                <form action="{{ route('professional_payments.destroy', $payment->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este registro de pagamento? Os atendimentos associados serão desvinculados, mas não excluídos.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                                                </form>
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