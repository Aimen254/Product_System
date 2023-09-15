<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Archive Application')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Archive Application')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Applied For')); ?></th>
                                <th><?php echo e(__('Rating')); ?></th>
                                <th><?php echo e(__('Applied at')); ?></th>
                                <th><?php echo e(__('CV / Resume')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $archive_application; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a class="" href="<?php echo e(route('job-application.show',\Crypt::encrypt($application->id))); ?>">  <?php echo e($application->name); ?></a></td>
                                    <td><?php echo e(!empty($application->jobs)?$application->jobs->title:'-'); ?></td>
                                    <td>
                                        <span class="static-rating static-rating-sm d-block">
                                            <?php for($i=1; $i<=5; $i++): ?>
                                                <?php if($i <= $application->rating): ?>
                                                    <i class="star ti ti-star voted"></i>
                                                <?php else: ?>
                                                    <i class="star ti ti-star"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                         </span>
                                    </td>
                                    <td><?php echo e(\Auth::user()->dateFormat($application->created_at)); ?></td>
                                    <td>
                                        <?php if(!empty($application->resume)): ?>
                                            <span class="text-sm action-btn bg-primary ms-2">
                                                <a href="<?php echo e(asset(Storage::url('uploads/job/resume')).'/'.$application->resume); ?>" target="_blank"><i class="ti ti-download text-white mx-3 btn btn-sm  align-items-center"></i></a>
                                            </span>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show job application')): ?>
                                        <div class="action-btn bg-info ms-2">

                                            <a class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-title="<?php echo e(__('Details')); ?>" href="<?php echo e(route('job-application.show',\Crypt::encrypt($application->id))); ?>"> <i class="ti ti-eye text-white"></i></a>
                                    </div>
                                            <?php endif; ?>
                                    </td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/babarras/public_html/crm/resources/views/jobApplication/candidate.blade.php ENDPATH**/ ?>