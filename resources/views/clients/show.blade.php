<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Cliente: ') }}<span class="text-indigo-600">{{ $client->full_name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">{{ __('Informações do Responsável') }}<a href="{{ route('clients.edit', $client->id) }}" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            {{ __('Editar Cliente') }}
        </a></h3>
                        
                        <p><strong>Nome Completo:</strong> {{ $client->full_name }}</p>
                        <p><strong>Telefone:</strong> {{ $client->phone }}</p>
                        <p><strong>Email:</strong> {{ $client->email }}</p>
                        <p><strong>CPF:</strong> {{ $client->cpf }}</p>
                        <p><strong>Endereço:</strong> {{ $client->address }}, {{ $client->neighborhood }} - {{ $client->city }} / {{ $client->state }}</p>
                    </div>

                    <hr class="my-6">

                    <h3 class="font-bold text-lg mb-4">{{ __('Filhos Cadastrados') }}
                        <a href="{{ route('children.create', $client->id) }}" class="ml-4 inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Adicionar Novo Filho(a)') }}
                        </a>
                    </h3>

                    @if ($client->children->isEmpty())
                        <p>Este cliente ainda não tem filhos cadastrados.</p>
                    @else
                        @foreach ($client->children as $child)
                            <div class="mb-6 border-b pb-4">
                                <h4 class="font-semibold text-md mb-2">{{ $child->name }} ({{ $child->age }} anos) <a href="{{ route('children.edit', [$client->id, $child->id]) }}" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Editar Filho') }}
            </a></h4>
                                <p><strong>Diagnóstico:</strong> {{ $child->diagnosis }}</p>
                                <p><strong>Grau do TEA:</strong> {{ $child->tea_level }}</p>
                                <p><strong>Verbal:</strong> {{ $child->is_verbal === 1 ? 'Sim' : ($child->is_verbal === 0 ? 'Não' : 'Pouco verbal') }}</p>
                                <p><strong>Dificuldades Principais:</strong> {{ $child->main_difficulties ?? 'Não informado' }}</p>
                                <p><strong>Estratégias de Calmaria:</strong> {{ $child->calming_strategies ?? 'Não informado' }}</p>

                                <div class="mt-2">
                                    <h5 class="font-medium text-sm">Autonomia:</h5>
                                    <ul>
                                        <li>Banheiro: {{ $child->toilet_autonomy ?? 'Não informado' }}</li>
                                        <li>Alimentar-se: {{ $child->feeding_autonomy ?? 'Não informado' }}</li>
                                        <li>Higiene Pessoal: {{ $child->hygiene_autonomy ?? 'Não informado' }}</li>
                                    </ul>
                                </div>

                                <div class="mt-2">
                                    <h5 class="font-medium text-sm">Tarefas Esperadas da Babá:</h5>
                                    <ul>
                                        @forelse ($child->babysitter_tasks as $task)
                                            <li>- {{ $task }}</li>
                                        @empty
                                            <li>Nenhuma tarefa específica informada.</li>
                                        @endforelse
                                    </ul>
                                </div>
                                </div>
                        @endforeach
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('clients.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Voltar para a Lista de Clientes') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>