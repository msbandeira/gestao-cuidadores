<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Status do Pagamento para: ') }}<span class="text-indigo-600">{{ $payment->professional->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('professional_payments.update', $payment->id) }}">
                        @csrf
                        @method('PUT')

                        <p class="mb-4"><strong>Profissional:</strong> {{ $payment->professional->name }}</p>
                        <p class="mb-4"><strong>Período:</strong> {{ $payment->start_date->format('d/m/Y') }} - {{ $payment->end_date->format('d/m/Y') }}</p>
                        <p class="mb-4"><strong>Total a Pagar:</strong> R$ {{ number_format($payment->total_repass_amount, 2, ',', '.') }}</p>

                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status do Pagamento')" />
                            <select id="status" name="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="pendente" {{ old('status', $payment->status) == 'pendente' ? 'selected' : '' }}>Pendente (Em Faturamento)</option>
                                <option value="processando" {{ old('status', $payment->status) == 'processando' ? 'selected' : '' }}>Processando</option>
                                <option value="pago" {{ old('status', $payment->status) == 'pago' ? 'selected' : '' }}>Pago</option>
                                <option value="cancelado" {{ old('status', $payment->status) == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="mb-4" id="payment_date_div">
                            <x-input-label for="payment_date" :value="__('Data do Pagamento (se status for Pago)')" />
                            <x-text-input id="payment_date" class="block mt-1 w-full" type="date" name="payment_date" :value="old('payment_date', $payment->payment_date ? $payment->payment_date->format('Y-m-d') : '')" />
                            <x-input-error :messages="$errors->get('payment_date')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Observações (Opcional)')" />
                            <textarea id="notes" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="notes" rows="3">{{ old('notes', $payment->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Atualizar Pagamento') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <a href="{{ route('professional_payments.show', $payment->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para Detalhes do Pagamento') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusSelect = document.getElementById('status');
            const paymentDateDiv = document.getElementById('payment_date_div');
            const paymentDateInput = document.getElementById('payment_date');

            function togglePaymentDateVisibility() {
                if (statusSelect.value === 'pago') {
                    paymentDateDiv.style.display = 'block';
                    paymentDateInput.setAttribute('required', 'required'); // Torna o campo obrigatório
                } else {
                    paymentDateDiv.style.display = 'none';
                    paymentDateInput.removeAttribute('required'); // Remove a obrigatoriedade
                    paymentDateInput.value = ''; // Limpa o valor se não for 'paid'
                }
            }

            statusSelect.addEventListener('change', togglePaymentDateVisibility);

            // Initialize on page load
            togglePaymentDateVisibility();
        });
    </script>
</x-app-layout>