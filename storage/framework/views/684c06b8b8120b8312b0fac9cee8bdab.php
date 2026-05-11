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
            <?php echo e(__('Registros de Pagamento de Profissionais')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="<?php echo e(route('professional_payments.create')); ?>" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <?php echo e(__('Gerar Novo Pagamento')); ?>

                        </a>
                        
                        <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <?php echo e(__('Voltar para Painel Principal')); ?>

                        </a>
                    
                    </div>
                    

                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if($payments->isEmpty()): ?>
                        <p>Nenhum registro de pagamento gerado ainda.</p>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profissional</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Período</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Repasse</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data Pagamento</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($payment->professional->full_name); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($payment->start_date->format('d/m/Y')); ?> - <?php echo e($payment->end_date->format('d/m/Y')); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">R$ <?php echo e(number_format($payment->total_repass_amount, 2, ',', '.')); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php
                                                    $statusClass = '';
                                                    switch ($payment->status) {
                                                        case 'pendente': $statusClass = 'bg-yellow-50 text-yellow-700 ring-yellow-600/20'; break;
                                                        case 'processando': $statusClass = 'bg-blue-50 text-blue-700 ring-blue-600/20'; break;
                                                        case 'pago': $statusClass = 'bg-green-50 text-green-700 ring-green-600/20'; break;
                                                        case 'cancelado': $statusClass = 'bg-red-50 text-red-700 ring-red-600/20'; break;
                                                    }
                                                ?>
                                                <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo e($statusClass); ?>">
                                                    <?php echo e(ucfirst($payment->status)); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($payment->payment_date ? $payment->payment_date->format('d/m/Y') : 'N/A'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="<?php echo e(route('professional_payments.show', $payment->id)); ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">Ver Detalhes</a>
                                                <a href="<?php echo e(route('professional_payments.edit', $payment->id)); ?>" class="text-blue-600 hover:text-blue-900 mr-4">Editar Status</a>
                                                <form action="<?php echo e(route('professional_payments.destroy', $payment->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este registro de pagamento? Os atendimentos associados serão desvinculados, mas não excluídos.');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                                                </form>
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
<?php endif; ?><?php /**PATH /home/storage/6/32/c4/rederara1/public_html/gestao-cuidadores/resources/views/professional_payments/index.blade.php ENDPATH**/ ?>