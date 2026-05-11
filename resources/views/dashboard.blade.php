<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg font-semibold mb-6">
                        {{ __("Bem-vindo,") }} {{ Auth::user()->name }}!
                        {{ __("Escolha uma opção para iniciar:") }}
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        @can('acessar-admin')
                            <a href="{{ route('admin.dashboard') }}" class="block p-6 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Dashboard Administrativo') }}</h3>
                                <p>{{ __('Gerencie o sistema, finanças, profissionais e planos de serviço.') }}</p>
                            </a>
                        @endcan

                        @can('acessar-admin')
                            <a href="{{ route('professionals.index') }}" class="block p-6 bg-teal-600 hover:bg-teal-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Profissionais') }}</h3>
                                <p>{{ __('Cadastro e gestão de profissionais e seus dados bancários.') }}</p>
                            </a>
                        @endcan
                        
                        @can('acessar-admin')
                            <a href="{{ route('service_plans.index') }}" class="block p-6 bg-orange-500 hover:bg-orange-600 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Planos de Serviço') }}</h3>
                                <p>{{ __('Gestão dos planos de atendimento oferecidos.') }}</p>
                            </a>
                        @endcan
                        
                        @can('acessar-admin')
                            <a href="{{ route('professional_payments.index') }}" class="block p-6 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Pagamentos de Profissionais') }}</h3>
                                <p>{{ __('Gestão e registro de repasses aos profissionais.') }}</p>
                            </a>
                        @endcan

                        @can('acessar-cliente-profissional-atendimento')
                            <a href="{{ route('clients.index') }}" class="block p-6 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Clientes') }}</h3>
                                <p>{{ __('Cadastro e gestão de clientes e seus dependentes.') }}</p>
                            </a>
                        @endcan

                        @can('acessar-cliente-profissional-atendimento')
                            <a href="{{ route('appointments.index') }}" class="block p-6 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Atendimentos') }}</h3>
                                <p>{{ __('Agenda e gestão dos atendimentos agendados.') }}</p>
                            </a>
                        @endcan

                        @can('acessar-admin')
                            <a href="{{ route('cash_flow.index') }}" class="block p-6 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Fluxo de Caixa') }}</h3>
                                <p>{{ __('Visualize as entradas e despesas da empresa.') }}</p>
                            </a>
                        @endcan
                        
                        @can('acessar-admin')
                            <a href="{{ route('revenues.index') }}" class="block p-6 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Entradas') }}</h3>
                                <p>{{ __('Gerencie as entradas de dinheiro da empresa.') }}</p>
                            </a>
                        @endcan
                        
                        @can('acessar-admin')
                            <a href="{{ route('expenses.index') }}" class="block p-6 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Despesas') }}</h3>
                                <p>{{ __('Gerencie as despesas de dinheiro da empresa.') }}</p>
                            </a>
                        @endcan

                        @can('acessar-admin')
                            <a href="{{ route('users.index') }}" class="block p-6 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2">{{ __('Usuarios') }}</h3>
                                <p>{{ __('Gestão de acessos e usuarios do sistema.') }}</p>
                            </a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>