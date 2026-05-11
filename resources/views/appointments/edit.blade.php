<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Atendimento') }}
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

                    <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="client_id" :value="__('Cliente')" />
                            <select id="client_id" name="client_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Selecione um cliente</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $appointment->client_id) == $client->id ? 'selected' : '' }}>{{ $client->cpf }} - {{ $client->full_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="professional_id" :value="__('Profissional')" />
                            <select id="professional_id" name="professional_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Selecione um profissional</option>
                                @foreach ($professionals as $professional)
                                    <option value="{{ $professional->id }}" {{ old('professional_id', $appointment->professional_id) == $professional->id ? 'selected' : '' }}>{{ $professional->full_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('professional_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="service_plan_id" :value="__('Plano de Serviço')" />
                            <select id="service_plan_id" name="service_plan_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Selecione um plano</option>
                                @foreach ($servicePlans as $plan)
                                    <option value="{{ $plan->id }}" data-price="{{ $plan->price }}" data-repass="{{ $plan->professional_repass_value }}" data-intake="{{ $plan->company_intake_value }}" {{ old('service_plan_id', $appointment->service_plan_id) == $plan->id ? 'selected' : '' }}>
                                        {{ $plan->name }} (R$ {{ number_format($plan->price, 2, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('service_plan_id')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="appointment_date" :value="__('Data e Hora do Atendimento')" />
                                <x-text-input id="appointment_date" class="block mt-1 w-full" type="datetime-local" name="appointment_date" :value="old('appointment_date', $appointment->appointment_date ? $appointment->appointment_date->format('Y-m-d\TH:i') : '')" required />
                                <x-input-error :messages="$errors->get('appointment_date')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="duration_minutes" :value="__('Duração (Minutos)')" />
                                <x-text-input id="duration_minutes" class="block mt-1 w-full" type="number" name="duration_minutes" :value="old('duration_minutes', $appointment->duration_minutes)" placeholder="Ex: 60" />
                                <x-input-error :messages="$errors->get('duration_minutes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <x-input-label for="price_charged" :value="__('Preço Cobrado (R$)')" />
                                <x-text-input id="price_charged" class="block mt-1 w-full" type="number" step="0.01" name="price_charged" :value="old('price_charged', $appointment->price_charged)" required />
                                <x-input-error :messages="$errors->get('price_charged')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="professional_repass" :value="__('Repasse p/ Profissional (R$)')" />
                                <x-text-input id="professional_repass" class="block mt-1 w-full" type="number" step="0.01" name="professional_repass" :value="old('professional_repass', $appointment->professional_repass)" />
                                <x-input-error :messages="$errors->get('professional_repass')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="company_intake" :value="__('Entrada p/ Empresa (R$)')" />
                                <x-text-input id="company_intake" class="block mt-1 w-full" type="number" step="0.01" name="company_intake" :value="old('company_intake', $appointment->company_intake)" />
                                <x-input-error :messages="$errors->get('company_intake')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status do Atendimento')" />
                            <select id="status" name="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="Agendado" {{ old('status') == 'Agendado' ? 'selected' : '' }}>Agendado</option>
                                <option value="Completo" {{ old('status') == 'Completo' ? 'selected' : '' }}>Completo</option>
                                <option value="Cancelado" {{ old('status') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                <option value="Agendado-Pago" {{ old('status') == 'Agendado-Pago' ? 'selected' : '' }}>Agendado / Pago</option>
                                
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Observações')" />
                            <textarea id="notes" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="notes" rows="3">{{ old('notes', $appointment->notes) }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Atualizar Atendimento') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Script para preencher automaticamente preço, repasse e entrada com base no plano selecionado
        document.addEventListener('DOMContentLoaded', function () {
            const servicePlanSelect = document.getElementById('service_plan_id');
            const priceChargedInput = document.getElementById('price_charged');
            const professionalRepassInput = document.getElementById('professional_repass');
            const companyIntakeInput = document.getElementById('company_intake');

            servicePlanSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.dataset.price;
                const repass = selectedOption.dataset.repass;
                const intake = selectedOption.dataset.intake;

                // Preenche os campos, mas permite que o usuário altere
                if (price) {
                    priceChargedInput.value = parseFloat(price).toFixed(2);
                } else {
                    priceChargedInput.value = '';
                }

                if (repass) {
                    professionalRepassInput.value = parseFloat(repass).toFixed(2);
                } else {
                    professionalRepassInput.value = '';
                }

                if (intake) {
                    companyIntakeInput.value = parseFloat(intake).toFixed(2);
                } else {
                    companyIntakeInput.value = '';
                }
            });

            // Trigger change on load if an old value was selected (for edit page)
            // This ensures the current values from the database are reflected,
            // and if the user changes the plan, the fields update.
            if (servicePlanSelect.value && !priceChargedInput.value && !professionalRepassInput.value && !companyIntakeInput.value) {
                const event = new Event('change');
                servicePlanSelect.dispatchEvent(event);
            }
        });
    </script>
</x-app-layout>