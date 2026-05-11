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
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-lg font-semibold mb-6">
                        <?php echo e(__("Bem-vindo,")); ?> <?php echo e(Auth::user()->name); ?>!
                        <?php echo e(__("Escolha uma opção para iniciar:")); ?>

                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-admin')): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="block p-6 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Dashboard Administrativo')); ?></h3>
                                <p><?php echo e(__('Gerencie o sistema, finanças, profissionais e planos de serviço.')); ?></p>
                            </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-admin')): ?>
                            <a href="<?php echo e(route('professionals.index')); ?>" class="block p-6 bg-teal-600 hover:bg-teal-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Profissionais')); ?></h3>
                                <p><?php echo e(__('Cadastro e gestão de profissionais e seus dados bancários.')); ?></p>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-admin')): ?>
                            <a href="<?php echo e(route('service_plans.index')); ?>" class="block p-6 bg-orange-500 hover:bg-orange-600 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Planos de Serviço')); ?></h3>
                                <p><?php echo e(__('Gestão dos planos de atendimento oferecidos.')); ?></p>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-admin')): ?>
                            <a href="<?php echo e(route('professional_payments.index')); ?>" class="block p-6 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Pagamentos de Profissionais')); ?></h3>
                                <p><?php echo e(__('Gestão e registro de repasses aos profissionais.')); ?></p>
                            </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-cliente-profissional-atendimento')): ?>
                            <a href="<?php echo e(route('clients.index')); ?>" class="block p-6 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Clientes')); ?></h3>
                                <p><?php echo e(__('Cadastro e gestão de clientes e seus dependentes.')); ?></p>
                            </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-cliente-profissional-atendimento')): ?>
                            <a href="<?php echo e(route('appointments.index')); ?>" class="block p-6 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Atendimentos')); ?></h3>
                                <p><?php echo e(__('Agenda e gestão dos atendimentos agendados.')); ?></p>
                            </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-admin')): ?>
                            <a href="<?php echo e(route('cash_flow.index')); ?>" class="block p-6 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Fluxo de Caixa')); ?></h3>
                                <p><?php echo e(__('Visualize as entradas e despesas da empresa.')); ?></p>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-admin')): ?>
                            <a href="<?php echo e(route('revenues.index')); ?>" class="block p-6 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Entradas')); ?></h3>
                                <p><?php echo e(__('Gerencie as entradas de dinheiro da empresa.')); ?></p>
                            </a>
                        <?php endif; ?>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-admin')): ?>
                            <a href="<?php echo e(route('expenses.index')); ?>" class="block p-6 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Despesas')); ?></h3>
                                <p><?php echo e(__('Gerencie as despesas de dinheiro da empresa.')); ?></p>
                            </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('acessar-admin')): ?>
                            <a href="<?php echo e(route('users.index')); ?>" class="block p-6 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md transition-colors duration-200">
                                <h3 class="text-xl font-bold mb-2"><?php echo e(__('Usuarios')); ?></h3>
                                <p><?php echo e(__('Gestão de acessos e usuarios do sistema.')); ?></p>
                            </a>
                        <?php endif; ?>

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
<?php endif; ?><?php /**PATH /home/storage/6/32/c4/rederara1/public_html/gestao-cuidadores/resources/views/dashboard.blade.php ENDPATH**/ ?>