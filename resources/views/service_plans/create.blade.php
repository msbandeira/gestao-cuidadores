<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Plano de Serviço') }}
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

                    <form method="POST" action="{{ route('service_plans.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nome do Plano')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Descrição do Plano')" />
                            <textarea id="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="description" rows="3">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="price" :value="__('Preço (R$)')" />
                                <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="old('price')" required />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="professional_repass_value" :value="__('Repasse p/ Profissional (R$)')" />
                                <x-text-input id="professional_repass_value" class="block mt-1 w-full" type="number" step="0.01" name="professional_repass_value" :value="old('professional_repass_value')" />
                                <x-input-error :messages="$errors->get('professional_repass_value')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="company_intake_value" :value="__('Entrada p/ Empresa (R$)')" />
                                <x-text-input id="company_intake_value" class="block mt-1 w-full" type="number" step="0.01" name="company_intake_value" :value="old('company_intake_value')" />
                                <x-input-error :messages="$errors->get('company_intake_value')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="plan_type" :value="__('Tipo de Plano')" />
                                <x-text-input id="plan_type" class="block mt-1 w-full" type="text" name="plan_type" :value="old('plan_type')" placeholder="Ex: Por Hora, Mensal, Avulso" />
                                <x-input-error :messages="$errors->get('plan_type')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="hours_included" :value="__('Horas Incluídas (se aplicável)')" />
                                <x-text-input id="hours_included" class="block mt-1 w-full" type="number" name="hours_included" :value="old('hours_included')" />
                                <x-input-error :messages="$errors->get('hours_included')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="days_validity" :value="__('Validade em Dias (se aplicável)')" />
                                <x-text-input id="days_validity" class="block mt-1 w-full" type="number" name="days_validity" :value="old('days_validity')" />
                                <x-input-error :messages="$errors->get('days_validity')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                <span class="ms-2 text-sm text-gray-600">{{ __('Plano Ativo (disponível para contratação)') }}</span>
                            </label>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="benefits" :value="__('Benefícios (um por linha)')" />
                            <textarea id="benefits" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="benefits" rows="4" placeholder="Ex:&#10- Suporte 24h&#10- Acompanhamento personalizado&#10- Desconto em eventos">{{ old('benefits') ? implode("\n", old('benefits')) : '' }}</textarea>
                            <x-input-error :messages="$errors->get('benefits')" class="mt-2" />
                            <small class="text-gray-500 text-xs">Cada benefício deve estar em uma nova linha.</small>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="restrictions" :value="__('Restrições (um por linha)')" />
                            <textarea id="restrictions" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="restrictions" rows="4" placeholder="Ex:&#10- Válido apenas em dias úteis&#10- Limite de 2 atendimentos por mês">{{ old('restrictions') ? implode("\n", old('restrictions')) : '' }}</textarea>
                            <x-input-error :messages="$errors->get('restrictions')" class="mt-2" />
                            <small class="text-gray-500 text-xs">Cada restrição deve estar em uma nova linha.</small>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Cadastrar Plano') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Script para converter o textarea de benefícios e restrições para array antes do envio
        document.querySelector('form').addEventListener('submit', function(e) {
            const benefitsTextarea = document.getElementById('benefits');
            const restrictionsTextarea = document.getElementById('restrictions');

            if (benefitsTextarea) {
                const benefits = benefitsTextarea.value.split('\n').map(item => item.trim()).filter(item => item !== '');
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'benefits';
                hiddenInput.value = JSON.stringify(benefits); // Envia como JSON string
                this.appendChild(hiddenInput);
                benefitsTextarea.remove(); // Remove o textarea para não enviar duas vezes
            }

            if (restrictionsTextarea) {
                const restrictions = restrictionsTextarea.value.split('\n').map(item => item.trim()).filter(item => item !== '');
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'restrictions';
                hiddenInput.value = JSON.stringify(restrictions); // Envia como JSON string
                this.appendChild(hiddenInput);
                restrictionsTextarea.remove(); // Remove o textarea para não enviar duas vezes
            }
        });
    </script>
</x-app-layout>