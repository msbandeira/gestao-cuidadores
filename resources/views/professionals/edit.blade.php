<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Profissional: ') }}<span class="text-indigo-600">{{ $professional->full_name }}</span>
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

                    <form method="POST" action="{{ route('professionals.update', $professional->id) }}">
                        @csrf
                        @method('PUT') <h3 class="font-bold text-lg mb-4">{{ __('1. Dados Pessoais') }}</h3>

                        <div class="mb-4">
                            <x-input-label for="full_name" :value="__('Nome Completo')" />
                            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name', $professional->full_name)" required autofocus />
                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <x-input-label for="phone" :value="__('Telefone')" />
                                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $professional->phone)" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $professional->email)" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="cpf" :value="__('CPF')" />
                                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf', $professional->cpf)" required />
                                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="date_of_birth" :value="__('Data de Nascimento')" />
                                <x-text-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth', $professional->date_of_birth ? $professional->date_of_birth->format('Y-m-d') : '')" />
                                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="gender" :value="__('Gênero')" />
                                <x-text-input id="gender" class="block mt-1 w-full" type="text" name="gender" :value="old('gender', $professional->gender)" placeholder="Ex: Feminino, Masculino, Outro" />
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="font-bold text-lg mb-4 mt-6">{{ __('2. Endereço') }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="address" :value="__('Endereço')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $professional->address)" />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="neighborhood" :value="__('Bairro')" />
                                <x-text-input id="neighborhood" class="block mt-1 w-full" type="text" name="neighborhood" :value="old('neighborhood', $professional->neighborhood)" />
                                <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <x-input-label for="city" :value="__('Cidade')" />
                                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $professional->city)" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="state" :value="__('Estado')" />
                                <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state', $professional->state)" />
                                <x-input-error :messages="$errors->get('state')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="zip_code" :value="__('CEP')" />
                                <x-text-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code" :value="old('zip_code', $professional->zip_code)" />
                                <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
                            </div>
                        </div>

                        <h3 class="font-bold text-lg mb-4 mt-6">{{ __('3. Formação e Experiência') }}</h3>
                        <div class="mb-4">
                            <x-input-label for="education_level" :value="__('Nível de Escolaridade')" />
                            <x-text-input id="education_level" class="block mt-1 w-full" type="text" name="education_level" :value="old('education_level', $professional->education_level)" placeholder="Ex: Ensino Médio Completo, Superior em Psicologia" />
                            <x-input-error :messages="$errors->get('education_level')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="relevant_courses" :value="__('Cursos relevantes (TEA, Primeiros Socorros, etc.)')" />
                            <textarea id="relevant_courses" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="relevant_courses" rows="3">{{ old('relevant_courses', $professional->relevant_courses) }}</textarea>
                            <x-input-error :messages="$errors->get('relevant_courses')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="experience_description" :value="__('Descreva sua experiência com crianças com TEA ou outras necessidades atípicas.')" />
                            <textarea id="experience_description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="experience_description" rows="5">{{ old('experience_description', $professional->experience_description) }}</textarea>
                            <x-input-error :messages="$errors->get('experience_description')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="experience_years" :value="__('Quantos anos de experiência nessa área?')" />
                            <x-text-input id="experience_years" class="block mt-1 w-full" type="text" name="experience_years" :value="old('experience_years', $professional->experience_years)" placeholder="Ex: 2 anos, 5+ anos" />
                            <x-input-error :messages="$errors->get('experience_years')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label :value="__('Especialidades/Funções que pode desempenhar:')" />
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="specialties[]" value="Babá" {{ in_array('Babá', old('specialties', $professional->specialties ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Babá</span>
                                </label><br>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="specialties[]" value="Acompanhante Terapêutico (AT)" {{ in_array('Acompanhante Terapêutico (AT)', old('specialties', $professional->specialties ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Acompanhante Terapêutico (AT)</span>
                                </label><br>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="specialties[]" value="Mediador Escolar" {{ in_array('Mediador Escolar', old('specialties', $professional->specialties ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Mediador Escolar</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="specialties[]" value="Outro" {{ in_array('Outro', old('specialties', $professional->specialties ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Outro</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('specialties')" class="mt-2" />
                        </div>

                        <h3 class="font-bold text-lg mb-4 mt-6">{{ __('4. Disponibilidade e Logística') }}</h3>

                        <div class="mb-4">
                            <x-input-label :value="__('Horários disponíveis:')" />
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="available_hours[]" value="Manhã" {{ in_array('Manhã', old('available_hours', $professional->available_hours ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Manhã</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="available_hours[]" value="Tarde" {{ in_array('Tarde', old('available_hours', $professional->available_hours ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Tarde</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="available_hours[]" value="Noite" {{ in_array('Noite', old('available_hours', $professional->available_hours ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Noite</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="available_hours[]" value="Finais de semana" {{ in_array('Finais de semana', old('available_hours', $professional->available_hours ?? [])) ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Finais de semana</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('available_hours')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="available_days_of_week" :value="__('Dias da semana disponíveis:')" />
                            <x-text-input id="available_days_of_week" class="block mt-1 w-full" type="text" name="available_days_of_week" :value="old('available_days_of_week', $professional->available_days_of_week)" placeholder="Ex: Segunda a Sexta, Fins de semana" />
                            <x-input-error :messages="$errors->get('available_days_of_week')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label :value="__('Aceita atuar em residências com pets?')" />
                                <div class="mt-2">
                                    <label class="inline-flex items-center mr-4">
                                        <input type="radio" class="form-radio" name="accepts_pets" value="1" {{ old('accepts_pets', $professional->accepts_pets) == 1 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Sim</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="accepts_pets" value="0" {{ old('accepts_pets', $professional->accepts_pets) == 0 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Não</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('accepts_pets')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label :value="__('Possui transporte próprio?')" />
                                <div class="mt-2">
                                    <label class="inline-flex items-center mr-4">
                                        <input type="radio" class="form-radio" name="has_own_transport" value="1" {{ old('has_own_transport', $professional->has_own_transport) == 1 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Sim</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="has_own_transport" value="0" {{ old('has_own_transport', $professional->has_own_transport) == 0 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Não</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('has_own_transport')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="transport_details" :value="__('Detalhes do transporte (se sim ou usa público)')" />
                            <x-text-input id="transport_details" class="block mt-1 w-full" type="text" name="transport_details" :value="old('transport_details', $professional->transport_details)" placeholder="Ex: Carro, Moto, Metrô e Ônibus" />
                            <x-input-error :messages="$errors->get('transport_details')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="preferred_regions" :value="__('Regiões/Bairros de preferência para atuar')" />
                            <textarea id="preferred_regions" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="preferred_regions" rows="2">{{ old('preferred_regions', $professional->preferred_regions) }}</textarea>
                            <x-input-error :messages="$errors->get('preferred_regions')" class="mt-2" />
                        </div>

                        <h3 class="font-bold text-lg mb-4 mt-6">{{ __('5. Informações Adicionais para Matching') }}</h3>

                        <div class="mb-4">
                            <x-input-label :value="__('Grau do TEA:')" />
                            <div class="mt-2">
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="tea_level" value="Nível 1" {{ old('tea_level', $professional->tea_level) == 'Nível 1' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Nível 1</span>
                                </label>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" class="form-radio" name="tea_level" value="Nível 2" {{ old('tea_level', $professional->tea_level) == 'Nível 2' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Nível 2</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="tea_level" value="Nível 3" {{ old('tea_level', $professional->tea_level) == 'Nível 3' ? 'checked' : '' }}>
                                    <span class="ms-2 text-sm text-gray-600">Nível 3</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('tea_level')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="personal_description" :value="__('Descreva um pouco sobre você e seu estilo de trabalho como cuidador.')" />
                            <textarea id="personal_description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="personal_description" rows="5">{{ old('personal_description', $professional->personal_description) }}</textarea>
                            <x-input-error :messages="$errors->get('personal_description')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="communication_style" :value="__('Seu estilo de comunicação (Ex: Direta, paciente, lúdica, tranquila)')" />
                            <x-text-input id="communication_style" class="block mt-1 w-full" type="text" name="communication_style" :value="old('communication_style', $professional->communication_style)" />
                            <x-input-error :messages="$errors->get('communication_style')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="calming_strategies_knowledge" :value="__('Conhecimento em estratégias de acalmia/regulação para crianças com TEA? Quais?')" />
                            <textarea id="calming_strategies_knowledge" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="calming_strategies_knowledge" rows="3">{{ old('calming_strategies_knowledge', $professional->calming_strategies_knowledge) }}</textarea>
                            <x-input-error :messages="$errors->get('calming_strategies_knowledge')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label :value="__('Possui treinamento em Primeiros Socorros?')" />
                                <div class="mt-2">
                                    <label class="inline-flex items-center mr-4">
                                        <input type="radio" class="form-radio" name="first_aid_training" value="1" {{ old('first_aid_training', $professional->first_aid_training) == 1 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Sim</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="first_aid_training" value="0" {{ old('first_aid_training', $professional->first_aid_training) == 0 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Não</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('first_aid_training')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label :value="__('Possui CNH (Carteira Nacional de Habilitação)?')" />
                                <div class="mt-2">
                                    <label class="inline-flex items-center mr-4">
                                        <input type="radio" class="form-radio" name="has_cnh" value="1" {{ old('has_cnh', $professional->has_cnh) == 1 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Sim</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="has_cnh" value="0" {{ old('has_cnh', $professional->has_cnh) == 0 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Não</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('has_cnh')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <x-input-label :value="__('Você é fumante?')" />
                                <div class="mt-2">
                                    <label class="inline-flex items-center mr-4">
                                        <input type="radio" class="form-radio" name="smoker" value="1" {{ old('smoker', $professional->smoker) == 1 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Sim</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="smoker" value="0" {{ old('smoker', $professional->smoker) == 0 ? 'checked' : '' }}>
                                        <span class="ms-2 text-sm text-gray-600">Não</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('smoker')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="religion" :value="__('Religião (Opcional)')" />
                                <x-text-input id="religion" class="block mt-1 w-full" type="text" name="religion" :value="old('religion', $professional->religion)" />
                                <x-input-error :messages="$errors->get('religion')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="spoken_languages" :value="__('Idiomas Falados')" />
                                <x-text-input id="spoken_languages" class="block mt-1 w-full" type="text" name="spoken_languages" :value="old('spoken_languages', $professional->spoken_languages)" placeholder="Ex: Português, Inglês" />
                                <x-input-error :messages="$errors->get('spoken_languages')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Atualizar Profissional') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>