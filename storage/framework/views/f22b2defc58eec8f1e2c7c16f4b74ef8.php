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
            <?php echo e(__('Detalhes do Atendimento')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('Informações do Atendimento')); ?>

                            <a href="<?php echo e(route('appointments.edit', $appointment->id)); ?>" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('Editar Atendimento')); ?>

                            </a>
                        </h3>
                        <p><strong>Cliente:</strong> <?php echo e($appointment->client->full_name); ?></p>
                        <p><strong>Profissional:</strong> <?php echo e($appointment->professional->full_name); ?></p>
                        <p><strong>Plano de Serviço:</strong> <?php echo e($appointment->servicePlan->name); ?></p>
                        <p><strong>Data e Hora:</strong> <?php echo e($appointment->appointment_date->format('d/m/Y H:i')); ?></p>
                        <p><strong>Duração:</strong> <?php echo e($appointment->duration_minutes ? $appointment->duration_minutes . ' minutos' : 'N/A'); ?></p>
                        <p><strong>Preço Cobrado:</strong> R$ <?php echo e(number_format($appointment->price_charged, 2, ',', '.')); ?></p>
                        <p><strong>Repasse para Profissional:</strong> R$ <?php echo e(number_format($appointment->professional_repass, 2, ',', '.')); ?></p>
                        <p><strong>Entrada para Empresa:</strong> R$ <?php echo e(number_format($appointment->company_intake, 2, ',', '.')); ?></p>
                        <p><strong>Status:</strong>
                            <?php
                                $statusClass = '';
                                switch ($appointment->status) {
                                    case 'Agendado': $statusClass = 'bg-blue-50 text-blue-700 ring-blue-600/20'; break;
                                    case 'Completo': $statusClass = 'bg-green-50 text-green-700 ring-green-600/20'; break;
                                    case 'Cancelado': $statusClass = 'bg-red-50 text-red-700 ring-red-600/20'; break;
                                    case 'Agendado-Pago': $statusClass = 'bg-yellow-50 text-yellow-700 ring-yellow-600/20'; break;
                                    case 'no-show': $statusClass = 'bg-gray-50 text-gray-700 ring-gray-600/20'; break;
                                }
                            ?>
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo e($statusClass); ?>">
                                <?php echo e(ucfirst(str_replace('-', ' ', $appointment->status))); ?>

                            </span>
                        </p>
                        <p><strong>Observações:</strong> <?php echo e($appointment->notes ?? 'N/A'); ?></p>
                    </div>

                    <div class="mt-6">
                        <a href="<?php echo e(route('appointments.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <?php echo e(__('Voltar para a Lista de Atendimentos')); ?>

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
<?php endif; ?><?php /**PATH /home/storage/6/32/c4/rederara1/public_html/gestao-cuidadores/resources/views/appointments/show.blade.php ENDPATH**/ ?>