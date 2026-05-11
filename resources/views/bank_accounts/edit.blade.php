<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dados Bancários do Profissional: ') }}<span class="text-indigo-600">{{ $professional->name }}</span>
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
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
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

                    <form method="POST" action="{{ route('professionals.bank_accounts.update', $professional->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="bank_name" :value="__('Nome do Banco')" />
                            <x-text-input id="bank_name" class="block mt-1 w-full" type="text" name="bank_name" :value="old('bank_name', $bankAccount->bank_name ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="agency" :value="__('Agência')" />
                                <x-text-input id="agency" class="block mt-1 w-full" type="text" name="agency" :value="old('agency', $bankAccount->agency ?? '')" required />
                                <x-input-error :messages="$errors->get('agency')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="account_number" :value="__('Conta')" />
                                <x-text-input id="account_number" class="block mt-1 w-full" type="text" name="account_number" :value="old('account_number', $bankAccount->account_number ?? '')" required />
                                <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="account_type" :value="__('Tipo de Conta (Opcional)')" />
                            <select id="account_type" name="account_type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Selecione</option>
                                <option value="Corrente" {{ old('account_type', $bankAccount->account_type ?? '') == 'Corrente' ? 'selected' : '' }}>Corrente</option>
                                <option value="Poupança" {{ old('account_type', $bankAccount->account_type ?? '') == 'Poupança' ? 'selected' : '' }}>Poupança</option>
                            </select>
                            <x-input-error :messages="$errors->get('account_type')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="pix_key" :value="__('Chave Pix (Opcional)')" />
                            <x-text-input id="pix_key" class="block mt-1 w-full" type="text" name="pix_key" :value="old('pix_key', $bankAccount->pix_key ?? '')" />
                            <x-input-error :messages="$errors->get('pix_key')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Salvar Dados Bancários') }}
                            </x-primary-button>
                        </div>
                    </form>

                    @if($bankAccount)
                        <form action="{{ route('professionals.bank_accounts.destroy', $professional->id) }}" method="POST" class="inline-block mt-4" onsubmit="return confirm('Tem certeza que deseja remover os dados bancários deste profissional? Esta ação é irreversível.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Remover Dados Bancários') }}
                            </button>
                        </form>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('professionals.show', $professional->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para o Profissional') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>