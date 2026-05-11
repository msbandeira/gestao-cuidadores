<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Detalhes do Profissional: ')); ?><span class="text-indigo-600"><?php echo e($professional->full_name); ?></span>
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('1. Dados Pessoais')); ?>

                            <a href="<?php echo e(route('professionals.edit', $professional->id)); ?>" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('Editar Profissional')); ?>

                            </a>
                            <a href="<?php echo e(route('professionals.bank_accounts.edit', $professional->id)); ?>" class="ml-4 inline-flex items-center px-3 py-1 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('Gerenciar Dados Bancários')); ?>

                            </a>
                        </h3>
                        <p><strong>Nome Completo:</strong> <?php echo e($professional->full_name); ?></p>
                        <p><strong>Telefone:</strong> <?php echo e($professional->phone ?? 'N/A'); ?></p>
                        <p><strong>Email:</strong> <?php echo e($professional->email); ?></p>
                        <p><strong>CPF:</strong> <?php echo e($professional->cpf); ?></p>
                        <p><strong>Data de Nascimento:</strong> <?php echo e($professional->date_of_birth ? $professional->date_of_birth->format('d/m/Y') : 'N/A'); ?></p>
                        <p><strong>Gênero:</strong> <?php echo e($professional->gender ?? 'N/A'); ?></p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('2. Endereço')); ?></h3>
                        <p><strong>Endereço:</strong> <?php echo e($professional->address ?? 'N/A'); ?></p>
                        <p><strong>Bairro:</strong> <?php echo e($professional->neighborhood ?? 'N/A'); ?></p>
                        <p><strong>Cidade/Estado/CEP:</strong> <?php echo e($professional->city ?? 'N/A'); ?> / <?php echo e($professional->state ?? 'N/A'); ?> / <?php echo e($professional->zip_code ?? 'N/A'); ?></p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('3. Formação e Experiência')); ?></h3>
                        <p><strong>Nível de Escolaridade:</strong> <?php echo e($professional->education_level ?? 'N/A'); ?></p>
                        <p><strong>Cursos Relevantes:</strong> <?php echo e($professional->relevant_courses ?? 'N/A'); ?></p>
                        <p><strong>Descrição da Experiência:</strong> <?php echo e($professional->experience_description ?? 'N/A'); ?></p>
                        <p><strong>Anos de Experiência:</strong> <?php echo e($professional->experience_years ?? 'N/A'); ?></p>
                        <p><strong>Especialidades:</strong>
                            <?php $__empty_1 = true; $__currentLoopData = $professional->specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10"><?php echo e($specialty); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                N/A
                            <?php endif; ?>
                        </p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('4. Disponibilidade e Logística')); ?></h3>
                        <p><strong>Horários Disponíveis:</strong>
                            <?php $__empty_1 = true; $__currentLoopData = $professional->available_hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-700/10"><?php echo e($hour); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                N/A
                            <?php endif; ?>
                        </p>
                        <p><strong>Dias da Semana Disponíveis:</strong> <?php echo e($professional->available_days_of_week ?? 'N/A'); ?></p>
                        <p><strong>Aceita Pets:</strong> <?php echo e($professional->accepts_pets === 1 ? 'Sim' : ($professional->accepts_pets === 0 ? 'Não' : 'N/A')); ?></p>
                        <p><strong>Possui Transporte Próprio:</strong> <?php echo e($professional->has_own_transport === 1 ? 'Sim' : ($professional->has_own_transport === 0 ? 'Não' : 'N/A')); ?></p>
                        <p><strong>Detalhes do Transporte:</strong> <?php echo e($professional->transport_details ?? 'N/A'); ?></p>
                        <p><strong>Regiões Preferidas:</strong> <?php echo e($professional->preferred_regions ?? 'N/A'); ?></p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('5. Informações Adicionais para Matching')); ?></h3>
                        <p><strong>Descrição Pessoal:</strong> <?php echo e($professional->personal_description ?? 'N/A'); ?></p>
                        <p><strong>Estilo de Comunicação:</strong> <?php echo e($professional->communication_style ?? 'N/A'); ?></p>
                        <p><strong>Conhecimento em Estratégias de Calmia:</strong> <?php echo e($professional->calming_strategies_knowledge ?? 'N/A'); ?></p>
                        <p><strong>Treinamento em Primeiros Socorros:</strong> <?php echo e($professional->first_aid_training === 1 ? 'Sim' : ($professional->first_aid_training === 0 ? 'Não' : 'N/A')); ?></p>
                        <p><strong>Possui CNH:</strong> <?php echo e($professional->has_cnh === 1 ? 'Sim' : ($professional->has_cnh === 0 ? 'Não' : 'N/A')); ?></p>
                        <p><strong>Fumante:</strong> <?php echo e($professional->smoker === 1 ? 'Sim' : ($professional->smoker === 0 ? 'Não' : 'N/A')); ?></p>
                        <p><strong>Religião:</strong> <?php echo e($professional->religion ?? 'N/A'); ?></p>
                        <p><strong>Idiomas Falados:</strong> <?php echo e($professional->spoken_languages ?? 'N/A'); ?></p>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('Dados Bancários')); ?></h3>
                        <?php if($professional->bankAccount): ?>
                            <p><strong>Banco:</strong> <?php echo e($professional->bankAccount->bank_name); ?></p>
                            <p><strong>Agência:</strong> <?php echo e($professional->bankAccount->agency); ?></p>
                            <p><strong>Conta:</strong> <?php echo e($professional->bankAccount->account_number); ?></p>
                            <p><strong>Tipo de Conta:</strong> <?php echo e($professional->bankAccount->account_type ?? 'N/A'); ?></p>
                            <p><strong>Chave Pix:</strong> <?php echo e($professional->bankAccount->pix_key ?? 'N/A'); ?></p>
                        <?php else: ?>
                            <p>Nenhum dado bancário cadastrado para este profissional.</p>
                            <a href="<?php echo e(route('professionals.bank_accounts.edit', $professional->id)); ?>" class="mt-4 inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('Cadastrar Dados Bancários')); ?>

                            </a>
                        <?php endif; ?>
                    </div>                    

                    <div class="mt-6">
                        <a href="<?php echo e(route('professionals.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <?php echo e(__('Voltar para a Lista de Profissionais')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/storage/6/32/c4/rederara1/public_html/gestao-cuidadores/resources/views/professionals/show.blade.php ENDPATH**/ ?>