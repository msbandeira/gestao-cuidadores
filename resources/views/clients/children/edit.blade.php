<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Filho(a): ') }}<span class="text-indigo-600">{{ $child->name }}</span> (Cliente: {{ $client->full_name }})
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

                    <form method="POST" action="{{ route('children.update', [$client->id, $child->id]) }}">
                        @csrf
                        @method('PUT') <h3 class="font-bold text-lg mb-4">{{ __('1. Informações da Criança') }}</h3>

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nome Completo da Criança')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $child->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <x-input-label for="age" :value="__('Idade')" />
                                <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age', $child->age)" />
                                <x-input-error :messages="$errors->get('age')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="gender" :value="__('Gênero')" />
                                <x-text-input id="gender" class="block mt-1 w-full" type="text" name="gender" :value="old('gender', $child->gender)" />
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="diagnosis" :value="__('Diagnóstico(s)')" />
                                <x-text-input id="diagnosis" class="block mt-1 w-full" type="text" name="diagnosis" :value="old('diagnosis', $child->diagnosis)" />
                                <x-input-error :messages="$errors->get('diagnosis')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label :value="__('Grau do TEA:')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="tea_level" value="Nível 1" {{ old('tea_level', $child->tea_level) == 'Nível 1' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Nível 1</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="tea_level" value="Nível 2" {{ old('tea_level', $child->tea_level) == 'Nível 2' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Nível 2</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="tea_level" value="Nível 3" {{ old('tea_level', $child->tea_level) == 'Nível 3' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Nível 3</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('tea_level')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="associated_conditions" :value="__('Outras condições associadas? (ex: TDAH, epilepsia, deficiência intelectual)')" />
                            <x-text-input id="associated_conditions" class="block mt-1 w-full" type="text" name="associated_conditions" :value="old('associated_conditions', $child->associated_conditions)" />
                            <x-input-error :messages="$errors->get('associated_conditions')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label :value="__('A criança é verbal?')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="is_verbal" value="1" {{ old('is_verbal', $child->is_verbal) === 1 ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Sim</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="is_verbal" value="0" {{ old('is_verbal', $child->is_verbal) === 0 ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Não</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="is_verbal" value="2" {{ old('is_verbal', $child->is_verbal) === 2 ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Pouco verbal</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('is_verbal')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label :value="__('Possui autonomia para:')" />
                            <div class="mt-2">
                                <span class="block text-sm text-gray-700">Ir ao banheiro?</span>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="toilet_autonomy" value="Sim" {{ old('toilet_autonomy', $child->toilet_autonomy) == 'Sim' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Sim</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="toilet_autonomy" value="Não" {{ old('toilet_autonomy', $child->toilet_autonomy) == 'Não' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Não</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="toilet_autonomy" value="Com ajuda" {{ old('toilet_autonomy', $child->toilet_autonomy) == 'Com ajuda' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Com ajuda</span>
                                </label>
                                <x-input-error :messages="$errors->get('toilet_autonomy')" class="mt-2" />
                            </div>
                            <div class="mt-2">
                                <span class="block text-sm text-gray-700">Alimentar-se?</span>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="feeding_autonomy" value="Sim" {{ old('feeding_autonomy', $child->feeding_autonomy) == 'Sim' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Sim</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="feeding_autonomy" value="Não" {{ old('feeding_autonomy', $child->feeding_autonomy) == 'Não' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Não</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="feeding_autonomy" value="Com ajuda" {{ old('feeding_autonomy', $child->feeding_autonomy) == 'Com ajuda' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Com ajuda</span>
                                </label>
                                <x-input-error :messages="$errors->get('feeding_autonomy')" class="mt-2" />
                            </div>
                            <div class="mt-2">
                                <span class="block text-sm text-gray-700">Higiene pessoal?</span>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="hygiene_autonomy" value="Sim" {{ old('hygiene_autonomy', $child->hygiene_autonomy) == 'Sim' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Sim</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="hygiene_autonomy" value="Não" {{ old('hygiene_autonomy', $child->hygiene_autonomy) == 'Não' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Não</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="hygiene_autonomy" value="Com ajuda" {{ old('hygiene_autonomy', $child->hygiene_autonomy) == 'Com ajuda' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Com ajuda</span>
                                </label>
                                <x-input-error :messages="$errors->get('hygiene_autonomy')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="font-bold text-lg mb-4 mt-6">{{ __('2. Comportamentos e Rotina') }}</h3>

                        <div class="mb-4">
                            <x-input-label :value="__('A criança tem comportamentos de autoagressão ou heteroagressão?')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="aggression_behavior" value="Sim" {{ old('aggression_behavior', $child->aggression_behavior) == 'Sim' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Sim</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="aggression_behavior" value="Não" {{ old('aggression_behavior', $child->aggression_behavior) == 'Não' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Não</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="aggression_behavior" value="Raros" {{ old('aggression_behavior', $child->aggression_behavior) == 'Raros' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Raros</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('aggression_behavior')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label :value="__('Tem rigidez com rotinas ou objetos?')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="routine_rigidity" value="1" {{ old('routine_rigidity', $child->routine_rigidity) === 1 ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Sim</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="routine_rigidity" value="0" {{ old('routine_rigidity', $child->routine_rigidity) === 0 ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Não</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('routine_rigidity')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="main_difficulties" :value="__('Quais são as principais dificuldades percebidas?')" />
                            <textarea id="main_difficulties" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="main_difficulties" rows="3">{{ old('main_difficulties', $child->main_difficulties) }}</textarea>
                            <x-input-error :messages="$errors->get('main_difficulties')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="calming_strategies" :value="__('Quais estratégias costumam funcionar para acalmar ou regular a criança?')" />
                            <textarea id="calming_strategies" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="calming_strategies" rows="3">{{ old('calming_strategies', $child->calming_strategies) }}</textarea>
                            <x-input-error :messages="$errors->get('calming_strategies')" class="mt-2" />
                        </div>

                        <h3 class="font-bold text-lg mb-4 mt-6">{{ __('3. Preferências e Necessidades da Família') }}</h3>

                        <div class="mb-4">
                            <x-input-label :value="__('Quais tarefas espera que a babá realize?')" />
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="babysitter_tasks[]" value="Supervisão e cuidado direto" {{ in_array('Supervisão e cuidado direto', old('babysitter_tasks', $child->babysitter_tasks ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Supervisão e cuidado direto</span>
                                </label><br>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="babysitter_tasks[]" value="Apoio nas AVDs (alimentação, higiene, vestir-se)" {{ in_array('Apoio nas AVDs (alimentação, higiene, vestir-se)', old('babysitter_tasks', $child->babysitter_tasks ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Apoio nas AVDs (alimentação, higiene, vestir-se)</span>
                                </label><br>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="babysitter_tasks[]" value="Atividades lúdicas e pedagógicas" {{ in_array('Atividades lúdicas e pedagógicas', old('babysitter_tasks', $child->babysitter_tasks ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Atividades lúdicas e pedagógicas</span>
                                </label><br>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="babysitter_tasks[]" value="Acompanhamento em terapias ou escola" {{ in_array('Acompanhamento em terapias ou escola', old('babysitter_tasks', $child->babysitter_tasks ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Acompanhamento em terapias ou escola</span>
                                </label><br>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="babysitter_tasks[]" value="Tarefas domésticas leves" {{ in_array('Tarefas domésticas leves', old('babysitter_tasks', $child->babysitter_tasks ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Tarefas domésticas leves</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('babysitter_tasks')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="ideal_babysitter_profile" :value="__('Qual o perfil ideal de babá para sua família? (responda livremente)')" />
                            <textarea id="ideal_babysitter_profile" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="ideal_babysitter_profile" rows="3">{{ old('ideal_babysitter_profile', $child->ideal_babysitter_profile) }}</textarea>
                            <x-input-error :messages="$errors->get('ideal_babysitter_profile')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <h4 class="font-medium text-base mb-2">{{ __('Existe alguma preferência quanto a:') }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="babysitter_age_preference" :value="__('Faixa etária da babá?')" />
                                    <x-text-input id="babysitter_age_preference" class="block mt-1 w-full" type="text" name="babysitter_age_preference" :value="old('babysitter_age_preference', $child->babysitter_age_preference)" />
                                    <x-input-error :messages="$errors->get('babysitter_age_preference')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="babysitter_gender_preference" :value="__('Gênero?')" />
                                    <x-text-input id="babysitter_gender_preference" class="block mt-1 w-full" type="text" name="babysitter_gender_preference" :value="old('babysitter_gender_preference', $child->babysitter_gender_preference)" />
                                    <x-input-error :messages="$errors->get('babysitter_gender_preference')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="babysitter_formation_experience" :value="__('Formação ou experiência?')" />
                                    <textarea id="babysitter_formation_experience" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="babysitter_formation_experience" rows="2">{{ old('babysitter_formation_experience', $child->babysitter_formation_experience) }}</textarea>
                                    <x-input-error :messages="$errors->get('babysitter_formation_experience')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="babysitter_other_preferences" :value="__('Religião, idioma, estilo de comunicação etc?')" />
                                    <textarea id="babysitter_other_preferences" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="babysitter_other_preferences" rows="2">{{ old('babysitter_other_preferences', $child->babysitter_other_preferences) }}</textarea>
                                    <x-input-error :messages="$errors->get('babysitter_other_preferences')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <h3 class="font-bold text-lg mb-4 mt-6">{{ __('4. Disponibilidade e Logística') }}</h3>

                        <div class="mb-4">
                            <x-input-label :value="__('Horário desejado:')" />
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="desired_hours[]" value="Manhã" {{ in_array('Manhã', old('desired_hours', $child->desired_hours ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Manhã</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="desired_hours[]" value="Tarde" {{ in_array('Tarde', old('desired_hours', $child->desired_hours ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Tarde</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="desired_hours[]" value="Noite" {{ in_array('Noite', old('desired_hours', $child->desired_hours ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Noite</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="desired_hours[]" value="Finais de semana" {{ in_array('Finais de semana', old('desired_hours', $child->desired_hours ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Finais de semana</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('desired_hours')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="available_days_of_week" :value="__('Dias da semana:')" />
                            <x-text-input id="available_days_of_week" class="block mt-1 w-full" type="text" name="available_days_of_week" :value="old('available_days_of_week', $child->available_days_of_week)" placeholder="Ex: Segunda a Sexta, Fins de semana" />
                            <x-input-error :messages="$errors->get('available_days_of_week')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="residence_neighborhood" :value="__('Bairro de residência:')" />
                                <x-text-input id="residence_neighborhood" class="block mt-1 w-full" type="text" name="residence_neighborhood" :value="old('residence_neighborhood', $child->residence_neighborhood)" />
                                <x-input-error :messages="$errors->get('residence_neighborhood')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="residence_city" :value="__('Cidade de residência:')" />
                                <x-text-input id="residence_city" class="block mt-1 w-full" type="text" name="residence_city" :value="old('residence_city', $child->residence_city)" />
                                <x-input-error :messages="$errors->get('residence_city')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label :value="__('Possui pet em casa?')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="has_pet" value="1" {{ old('has_pet', $child->has_pet) === 1 ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Sim</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="has_pet" value="0" {{ old('has_pet', $child->has_pet) === 0 ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Não</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('has_pet')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label :value="__('Tem acesso fácil a transporte público?')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="easy_public_transport" value="1" {{ old('easy_public_transport', $child->easy_public_transport) === 1 ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Sim</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="easy_public_transport" value="0" {{ old('easy_public_transport', $child->easy_public_transport) === 0 ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Não</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('easy_public_transport')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Atualizar Filho(a)') }}
                            </x-primary-button>
                            <a href="{{ route('clients.show', $client->id) }}" class="ms-4 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Voltar para Detalhes do Cliente') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>