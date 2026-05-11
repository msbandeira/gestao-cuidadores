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
            <?php echo e(__('Detalhes do Plano de Serviço: ')); ?><span class="text-indigo-600"><?php echo e($servicePlan->name); ?></span>
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('Informações do Plano')); ?>

                            <a href="<?php echo e(route('service_plans.edit', $servicePlan->id)); ?>" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('Editar Plano')); ?>

                            </a>
                        </h3>
                        <p><strong>Nome do Plano:</strong> <?php echo e($servicePlan->name); ?></p>
                        <p><strong>Descrição:</strong> <?php echo e($servicePlan->description ?? 'N/A'); ?></p>
                        <p><strong>Preço Total:</strong> R$ <?php echo e(number_format($servicePlan->price, 2, ',', '.')); ?></p>
                        <p><strong>Repasse para Profissional:</strong> R$ <?php echo e(number_format($servicePlan->professional_repass_value, 2, ',', '.')); ?></p>
                        <p><strong>Entrada para Empresa:</strong> R$ <?php echo e(number_format($servicePlan->company_intake_value, 2, ',', '.')); ?></p>
                        <p><strong>Tipo de Plano:</strong> <?php echo e($servicePlan->plan_type ?? 'N/A'); ?></p>
                        <p><strong>Horas Incluídas:</strong> <?php echo e($servicePlan->hours_included ?? 'N/A'); ?></p>
                        <p><strong>Validade em Dias:</strong> <?php echo e($servicePlan->days_validity ?? 'N/A'); ?></p>
                        <p><strong>Ativo:</strong>
                            <?php if($servicePlan->is_active): ?>
                                <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Sim</span>
                            <?php else: ?>
                                <span class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Não</span>
                            <?php endif; ?>
                        </p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('Benefícios')); ?></h3>
                        <?php if($servicePlan->benefits): ?>
                            <ul class="list-disc list-inside">
                                <?php $__currentLoopData = $servicePlan->benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($benefit); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p>Nenhum benefício listado.</p>
                        <?php endif; ?>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('Restrições')); ?></h3>
                        <?php if($servicePlan->restrictions): ?>
                            <ul class="list-disc list-inside">
                                <?php $__currentLoopData = $servicePlan->restrictions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restriction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($restriction); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p>Nenhuma restrição listada.</p>
                        <?php endif; ?>
                    </div>

                    <div class="mt-6">
                        <a href="<?php echo e(route('service_plans.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <?php echo e(__('Voltar para a Lista de Planos')); ?>

                        </a>
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
<?php endif; ?><?php /**PATH /home/storage/6/32/c4/rederara1/public_html/gestao-cuidadores/resources/views/service_plans/show.blade.php ENDPATH**/ ?>