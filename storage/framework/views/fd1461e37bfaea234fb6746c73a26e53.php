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
            <?php echo e(__('Detalhes do Cliente: ')); ?><span class="text-indigo-600"><?php echo e($client->full_name); ?></span>
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('Informações do Responsável')); ?><a href="<?php echo e(route('clients.edit', $client->id)); ?>" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <?php echo e(__('Editar Cliente')); ?>

        </a></h3>
                        
                        <p><strong>Nome Completo:</strong> <?php echo e($client->full_name); ?></p>
                        <p><strong>Telefone:</strong> <?php echo e($client->phone); ?></p>
                        <p><strong>Email:</strong> <?php echo e($client->email); ?></p>
                        <p><strong>CPF:</strong> <?php echo e($client->cpf); ?></p>
                        <p><strong>Endereço:</strong> <?php echo e($client->address); ?>, <?php echo e($client->neighborhood); ?> - <?php echo e($client->city); ?> / <?php echo e($client->state); ?></p>
                    </div>

                    <hr class="my-6">

                    <h3 class="font-bold text-lg mb-4"><?php echo e(__('Filhos Cadastrados')); ?>

                        <a href="<?php echo e(route('children.create', $client->id)); ?>" class="ml-4 inline-flex items-center px-3 py-1 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <?php echo e(__('Adicionar Novo Filho(a)')); ?>

                        </a>
                    </h3>

                    <?php if($client->children->isEmpty()): ?>
                        <p>Este cliente ainda não tem filhos cadastrados.</p>
                    <?php else: ?>
                        <?php $__currentLoopData = $client->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mb-6 border-b pb-4">
                                <h4 class="font-semibold text-md mb-2"><?php echo e($child->name); ?> (<?php echo e($child->age); ?> anos) <a href="<?php echo e(route('children.edit', [$client->id, $child->id])); ?>" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <?php echo e(__('Editar Filho')); ?>

            </a></h4>
                                <p><strong>Diagnóstico:</strong> <?php echo e($child->diagnosis); ?></p>
                                <p><strong>Grau do TEA:</strong> <?php echo e($child->tea_level); ?></p>
                                <p><strong>Verbal:</strong> <?php echo e($child->is_verbal === 1 ? 'Sim' : ($child->is_verbal === 0 ? 'Não' : 'Pouco verbal')); ?></p>
                                <p><strong>Dificuldades Principais:</strong> <?php echo e($child->main_difficulties ?? 'Não informado'); ?></p>
                                <p><strong>Estratégias de Calmaria:</strong> <?php echo e($child->calming_strategies ?? 'Não informado'); ?></p>

                                <div class="mt-2">
                                    <h5 class="font-medium text-sm">Autonomia:</h5>
                                    <ul>
                                        <li>Banheiro: <?php echo e($child->toilet_autonomy ?? 'Não informado'); ?></li>
                                        <li>Alimentar-se: <?php echo e($child->feeding_autonomy ?? 'Não informado'); ?></li>
                                        <li>Higiene Pessoal: <?php echo e($child->hygiene_autonomy ?? 'Não informado'); ?></li>
                                    </ul>
                                </div>

                                <div class="mt-2">
                                    <h5 class="font-medium text-sm">Tarefas Esperadas da Babá:</h5>
                                    <ul>
                                        <?php $__empty_1 = true; $__currentLoopData = $child->babysitter_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li>- <?php echo e($task); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <li>Nenhuma tarefa específica informada.</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <div class="mt-6">
                        <a href="<?php echo e(route('clients.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <?php echo e(__('Voltar para a Lista de Clientes')); ?>

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
<?php endif; ?><?php /**PATH /home/storage/6/32/c4/rederara1/public_html/gestao-cuidadores/resources/views/clients/show.blade.php ENDPATH**/ ?>