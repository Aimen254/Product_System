<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Contract')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Contract')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('contract.grid')); ?>"  data-bs-toggle="tooltip" title="<?php echo e(__('Grid View')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-layout-grid"></i>
        </a>
        <a href="#" data-size="md" data-url="<?php echo e(route('contract.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Contract')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo e(__('Subject')); ?></th>
                                <?php if(\Auth::user()->type!='client'): ?>
                                    <th scope="col"><?php echo e(__('Client')); ?></th>
                                <?php endif; ?>
                                <th scope="col"><?php echo e(__('Contract Type')); ?></th>
                                <th scope="col"><?php echo e(__('Contract Value')); ?></th>
                                <th scope="col"><?php echo e(__('Start Date')); ?></th>
                                <th scope="col"><?php echo e(__('End Date')); ?></th>
                                <th scope="col"><?php echo e(__('Description')); ?></th>
                                <?php if(\Auth::user()->type=='company'): ?>
                                    <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr class="font-style">
                                    <td><?php echo e($contract->subject); ?></td>
                                    <?php if(\Auth::user()->type!='client'): ?>
                                        <td><?php echo e(!empty($contract->clients)?$contract->clients->name:''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(!empty($contract->types)?$contract->types->name:''); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($contract->value)); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($contract->start_date )); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($contract->end_date )); ?></td>
                                    <td>
                                        <a href="#" class="action-item" data-url="<?php echo e(route('contract.description',$contract->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Desciption')); ?>" data-title="<?php echo e(__('Desciption')); ?>"><i class="fa fa-comment"></i></a>
                                    </td>
                                    <?php if(\Auth::user()->type=='company'): ?>
                                        <td class="action text-end">
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(route('contract.edit',$contract->id)); ?>" data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Contract')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['contract.destroy', $contract->id]]); ?>

                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/crm/resources/views/contract/index.blade.php ENDPATH**/ ?>