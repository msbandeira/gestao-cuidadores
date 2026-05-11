<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Profissionais (Cuidadores TEA)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <a href="{{ route('professionals.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Cadastrar Novo Profissional') }}
                            </a>
                            
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Voltar para Painel Principal') }}
                            </a>
                        </div>
                    </div>

                    <div class="mb-6 border p-4 rounded-lg bg-gray-50">
                        <form method="GET" action="{{ route('professionals.index') }}" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Especialidades:</label>
                                <div class="flex flex-wrap gap-4">
                                    @php
                                        $specialties = ['Babá','Mediador Escolar', 'Acompanhante Terapêutico (AT)', 'Outro'];
                                        $selectedSpecialties = request('specialties', []);
                                    @endphp
                                    @foreach ($specialties as $specialty)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="specialty-{{ Str::slug($specialty) }}" name="specialties[]" value="{{ $specialty }}" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ in_array($specialty, $selectedSpecialties) ? 'checked' : '' }}>
                                            <label for="specialty-{{ Str::slug($specialty) }}" class="ml-2 text-sm text-gray-600">{{ $specialty }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Disponibilidade (Dias da Semana):</label>
                                <div class="flex flex-wrap gap-4">
                                    @php
                                        $days = ['Manhã', 'Tarde', 'Noite', 'Finais de Semana'];
                                        $selectedDays = request('availability', []);
                                    @endphp
                                    @foreach ($days as $day)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="day-{{ Str::slug($day) }}" name="availability[]" value="{{ $day }}" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ in_array($day, $selectedDays) ? 'checked' : '' }}>
                                            <label for="day-{{ Str::slug($day) }}" class="ml-2 text-sm text-gray-600">{{ $day }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Nivel de TEA:</label>
                                <div class="flex flex-wrap gap-4">
                                    @php
                                        $tea_levels = ['Nivel 1', 'Nivel 2', 'Nivel 3'];
                                        $selectedTea = request('levels', []);
                                    @endphp
                                    @foreach ($tea_levels as $tea)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="tea-{{ Str::slug($tea) }}" name="levels[]" value="{{ $tea }}" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" {{ in_array($tea, $selectedTea) ? 'checked' : '' }}>
                                            <label for="tea-{{ Str::slug($tea) }}" class="ml-2 text-sm text-gray-600">{{ $tea }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Filtrar') }}
                                </button>
                                @if(request('specialties') || request('availability') || request('levels'))
                                    <a href="{{ route('professionals.index') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Limpar
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    
                    @if ($professionals->isEmpty())
                        <p>Nenhum profissional encontrado com os filtros aplicados.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CPF</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bairro</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Especialidades</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($professionals as $professional)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $professional->full_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $professional->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $professional->cpf }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $professional->phone }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $professional->neighborhood }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @forelse ($professional->specialties as $specialty)
                                                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ $specialty }}</span>
                                                @empty
                                                    N/A
                                                @endforelse
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('professionals.show', $professional->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Ver Detalhes</a>
                                                <a href="{{ route('professionals.edit', $professional->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
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