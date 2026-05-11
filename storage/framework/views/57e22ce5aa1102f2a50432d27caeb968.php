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
            <?php echo e(__('Detalhes do Registro de Pagamento')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('Informações do Pagamento')); ?>

                            <a href="<?php echo e(route('professional_payments.edit', $payment->id)); ?>" class="ml-4 inline-flex items-center px-3 py-1 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <?php echo e(__('Editar Status')); ?>

                            </a>
                        </h3>
                        <p><strong>Profissional:</strong> <?php echo e($payment->professional->full_name); ?></p>
                        <p><strong>Período de Atendimentos:</strong> <?php echo e($payment->start_date->format('d/m/Y')); ?> a <?php echo e($payment->end_date->format('d/m/Y')); ?></p>
                        <p><strong>Total de Repasse:</strong> R$ <?php echo e(number_format($payment->total_repass_amount, 2, ',', '.')); ?></p>
                        <p><strong>Status:</strong>
                            <?php
                                $statusClass = '';
                                switch ($payment->status) {
                                    case 'pending': $statusClass = 'bg-yellow-50 text-yellow-700 ring-yellow-600/20'; break;
                                    case 'processing': $statusClass = 'bg-blue-50 text-blue-700 ring-blue-600/20'; break;
                                    case 'paid': $statusClass = 'bg-green-50 text-green-700 ring-green-600/20'; break;
                                    case 'cancelled': $statusClass = 'bg-red-50 text-red-700 ring-red-600/20'; break;
                                }
                            ?>
                            <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo e($statusClass); ?>">
                                <?php echo e(ucfirst($payment->status)); ?>

                            </span>
                        </p>
                        <p><strong>Data do Pagamento:</strong> <?php echo e($payment->payment_date ? $payment->payment_date->format('d/m/Y') : 'Aguardando'); ?></p>
                        <p><strong>Observações:</strong> <?php echo e($payment->notes ?? 'N/A'); ?></p>
                        <p><strong>Criado em:</strong> <?php echo e($payment->created_at->format('d/m/Y H:i')); ?></p>
                    </div>

                    <hr class="my-6">

                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4"><?php echo e(__('Atendimentos Incluídos neste Pagamento')); ?></h3>
                        <?php if($payment->appointments->isEmpty()): ?>
                            <p>Nenhum atendimento associado a este registro de pagamento.</p>
                        <?php else: ?>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Atendimento</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plano</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Atendimento</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Repasse</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Atend.</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php $__currentLoopData = $payment->appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($appointment->id); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($appointment->client->full_name); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($appointment->servicePlan->name); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap"><?php echo e($appointment->appointment_date->format('d/m/Y H:i')); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap">R$ <?php echo e(number_format($appointment->professional_repass, 2, ',', '.')); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                                        <?php echo e(ucfirst(str_replace('-', ' ', $appointment->status))); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-6">
                        <a href="<?php echo e(route('professional_payments.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <?php echo e(__('Voltar para Registros de Pagamento')); ?>

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
<?php endif; ?><?php /**PATH /home/storage/6/32/c4/rederara1/public_html/gestao-cuidadores/resources/views/professional_payments/show.blade.php ENDPATH**/ ?>