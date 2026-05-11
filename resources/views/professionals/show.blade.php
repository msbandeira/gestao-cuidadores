<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Profissional: ') }}<span class="text-indigo-600">{{ $professional->full_name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('1. Dados Pessoais') }}
                            <a href="{{ route('professionals.edit', $professional->id) }}" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Editar Profissional') }}
                            </a>
                            <a href="{{ route('professionals.bank_accounts.edit', $professional->id) }}" class="ml-4 inline-flex items-center px-3 py-1 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Gerenciar Dados Bancários') }}
                            </a>
                        </h3>
                        <p><strong>Nome Completo:</strong> {{ $professional->full_name }}</p>
                        <p><strong>Telefone:</strong> {{ $professional->phone ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $professional->email }}</p>
                        <p><strong>CPF:</strong> {{ $professional->cpf }}</p>
                        <p><strong>Data de Nascimento:</strong> {{ $professional->date_of_birth ? $professional->date_of_birth->format('d/m/Y') : 'N/A' }}</p>
                        <p><strong>Gênero:</strong> {{ $professional->gender ?? 'N/A' }}</p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('2. Endereço') }}</h3>
                        <p><strong>Endereço:</strong> {{ $professional->address ?? 'N/A' }}</p>
                        <p><strong>Bairro:</strong> {{ $professional->neighborhood ?? 'N/A' }}</p>
                        <p><strong>Cidade/Estado/CEP:</strong> {{ $professional->city ?? 'N/A' }} / {{ $professional->state ?? 'N/A' }} / {{ $professional->zip_code ?? 'N/A' }}</p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('3. Formação e Experiência') }}</h3>
                        <p><strong>Nível de Escolaridade:</strong> {{ $professional->education_level ?? 'N/A' }}</p>
                        <p><strong>Cursos Relevantes:</strong> {{ $professional->relevant_courses ?? 'N/A' }}</p>
                        <p><strong>Descrição da Experiência:</strong> {{ $professional->experience_description ?? 'N/A' }}</p>
                        <p><strong>Anos de Experiência:</strong> {{ $professional->experience_years ?? 'N/A' }}</p>
                        <p><strong>Especialidades:</strong>
                            @forelse ($professional->specialties as $specialty)
                                <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ $specialty }}</span>
                            @empty
                                N/A
                            @endforelse
                        </p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('4. Disponibilidade e Logística') }}</h3>
                        <p><strong>Horários Disponíveis:</strong>
                            @forelse ($professional->available_hours as $hour)
                                <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-700/10">{{ $hour }}</span>
                            @empty
                                N/A
                            @endforelse
                        </p>
                        <p><strong>Dias da Semana Disponíveis:</strong> {{ $professional->available_days_of_week ?? 'N/A' }}</p>
                        <p><strong>Aceita Pets:</strong> {{ $professional->accepts_pets === 1 ? 'Sim' : ($professional->accepts_pets === 0 ? 'Não' : 'N/A') }}</p>
                        <p><strong>Possui Transporte Próprio:</strong> {{ $professional->has_own_transport === 1 ? 'Sim' : ($professional->has_own_transport === 0 ? 'Não' : 'N/A') }}</p>
                        <p><strong>Detalhes do Transporte:</strong> {{ $professional->transport_details ?? 'N/A' }}</p>
                        <p><strong>Regiões Preferidas:</strong> {{ $professional->preferred_regions ?? 'N/A' }}</p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('5. Informações Adicionais para Matching') }}</h3>
                        <p><strong>Descrição Pessoal:</strong> {{ $professional->personal_description ?? 'N/A' }}</p>
                        <p><strong>Estilo de Comunicação:</strong> {{ $professional->communication_style ?? 'N/A' }}</p>
                        <p><strong>Conhecimento em Estratégias de Calmia:</strong> {{ $professional->calming_strategies_knowledge ?? 'N/A' }}</p>
                        <p><strong>Treinamento em Primeiros Socorros:</strong> {{ $professional->first_aid_training === 1 ? 'Sim' : ($professional->first_aid_training === 0 ? 'Não' : 'N/A') }}</p>
                        <p><strong>Possui CNH:</strong> {{ $professional->has_cnh === 1 ? 'Sim' : ($professional->has_cnh === 0 ? 'Não' : 'N/A') }}</p>
                        <p><strong>Fumante:</strong> {{ $professional->smoker === 1 ? 'Sim' : ($professional->smoker === 0 ? 'Não' : 'N/A') }}</p>
                        <p><strong>Religião:</strong> {{ $professional->religion ?? 'N/A' }}</p>
                        <p><strong>Idiomas Falados:</strong> {{ $professional->spoken_languages ?? 'N/A' }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('Dados Bancários') }}</h3>
                        @if ($professional->bankAccount)
                            <p><strong>Banco:</strong> {{ $professional->bankAccount->bank_name }}</p>
                            <p><strong>Agência:</strong> {{ $professional->bankAccount->agency }}</p>
                            <p><strong>Conta:</strong> {{ $professional->bankAccount->account_number }}</p>
                            <p><strong>Tipo de Conta:</strong> {{ $professional->bankAccount->account_type ?? 'N/A' }}</p>
                            <p><strong>Chave Pix:</strong> {{ $professional->bankAccount->pix_key ?? 'N/A' }}</p>
                        @else
                            <p>Nenhum dado bancário cadastrado para este profissional.</p>
                            <a href="{{ route('professionals.bank_accounts.edit', $professional->id) }}" class="mt-4 inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Cadastrar Dados Bancários') }}
                            </a>
                        @endif
                    </div>                    

                    <div class="mt-6">
                        <a href="{{ route('professionals.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para a Lista de Profissionais') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>