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
            <?php echo e(__('Lista de Profissionais (Cuidadores TEA)')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <a href="<?php echo e(route('professionals.create')); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('Cadastrar Novo Profissional')); ?>

                            </a>
                            
                            <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('Voltar para Painel Principal')); ?>

                            </a>
                        </div>
                    </div>

                    <div class="mb-6 border p-4 rounded-lg bg-gray-50">
                        <form method="GET" action="<?php echo e(route('professionals.index')); ?>" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Especialidades:</label>
                                <div class="flex flex-wrap gap-4">
                                    <?php
                                        $specialties = ['Babá','Mediador Escolar', 'Acompanhante Terapêutico (AT)', 'Outro'];
                                        $selectedSpecialties = request('specialties', []);
                                    ?>
                                    <?php $__currentLoopData = $specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="specialty-<?php echo e(Str::slug($specialty)); ?>" name="specialties[]" value="<?php echo e($specialty); ?>" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" <?php echo e(in_array($specialty, $selectedSpecialties) ? 'checked' : ''); ?>>
                                            <label for="specialty-<?php echo e(Str::slug($specialty)); ?>" class="ml-2 text-sm text-gray-600"><?php echo e($specialty); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Disponibilidade (Dias da Semana):</label>
                                <div class="flex flex-wrap gap-4">
                                    <?php
                                        $days = ['Manhã', 'Tarde', 'Noite', 'Finais de Semana'];
                                        $selectedDays = request('availability', []);
                                    ?>
                                    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="day-<?php echo e(Str::slug($day)); ?>" name="availability[]" value="<?php echo e($day); ?>" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" <?php echo e(in_array($day, $selectedDays) ? 'checked' : ''); ?>>
                                            <label for="day-<?php echo e(Str::slug($day)); ?>" class="ml-2 text-sm text-gray-600"><?php echo e($day); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Nivel de TEA:</label>
                                <div class="flex flex-wrap gap-4">
                                    <?php
                                        $tea_levels = ['Nivel 1', 'Nivel 2', 'Nivel 3'];
                                        $selectedTea = request('levels', []);
                                    ?>
                                    <?php $__currentLoopData = $tea_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="tea-<?php echo e(Str::slug($tea)); ?>" name="levels[]" value="<?php echo e($tea); ?>" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" <?php echo e(in_array($tea, $selectedTea) ? 'checked' : ''); ?>>
                                            <label for="tea-<?php echo e(Str::slug($tea)); ?>" class="ml-2 text-sm text-gray-600"><?php echo e($tea); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <?php echo e(__('Filtrar')); ?>

                                </button>
                                <?php if(request('specialties') || request('availability') || request('levels')): ?>
                                    <a href="<?php echo e(route('professionals.index')); ?>" class="ml-2 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Limpar
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($professionals->isEmpty()): ?>
                        <p>Nenhum profissional encontrado com os filtros aplicados.</p>
                    <?php else: ?>
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
                                    <?php $__currentLoopData = $professionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $professional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($professional->full_name); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($professional->email); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($professional->cpf); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($professional->phone); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($professional->neighborhood); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php $__empty_1 = true; $__currentLoopData = $professional->specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10"><?php echo e($specialty); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    N/A
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="<?php echo e(route('professionals.show', $professional->id)); ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Ver Detalhes</a>
                                                <a href="<?php echo e(route('professionals.edit', $professional->id)); ?>" class="text-blue-600 hover:text-blue-900">Editar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
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
<?php endif; ?><?php /**PATH /home/storage/6/32/c4/rederara1/public_html/gestao-cuidadores/resources/views/professionals/index.blade.php ENDPATH**/ ?>