
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Journal Entry Create')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Double Entry')); ?></li>
    <li class="breadcrumb-item"><?php echo e(__('Journal Entry')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.repeater.min.js')); ?>"></script>
  
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

<?php echo e(Form::model($productServices, array('route' => array('label.update', $productServices->id), 'method' => 'PUT','enctype' => 'multipart/form-data'))); ?>

    <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
    <div class="row">
        <div class="col-xl-12">
            <div class="card repeater">
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                          
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0" data-repeater-list="boxdimens" id="sortable-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Box')); ?></th>
                                <th><?php echo e(__('Weight lbs')); ?></th>
                                <th><?php echo e(__('Unit Per Box')); ?> </th>
                                <th><?php echo e(__('Number of Boxess')); ?></th>
                                <th><?php echo e(__('Carrier Label')); ?></th>
                                <th><?php echo e(__('Recieving Label')); ?></th>
                                <th width="2%"></th>
                            </tr>
                            </thead>
                            <tbody class="ui-sortable" data-repeater-item>
                            <?php $__currentLoopData = $productService; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productServic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php
                                $box = $productServic->threepl;
                                  $thpl = $productServic->thpl($box);
                                ?>
                                <td>
                                    <div class="form-group price-input">
                                    <?php echo e(Form::text('threepl', $thpl->size, array('class' => 'form-control','required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input">
                                    <?php echo e(Form::number('weightlbs', $productServic->weightlbs, array('class' => 'form-control','required'=>'required'))); ?>

                                </td>
                                <td>
                                    <div class="form-group price-input">
                                    <?php echo e(Form::number('unitperbox', $productServic->unitperbox, array('class' => 'form-control','required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    <?php echo e(Form::number('boxno', $productServic->boxno, array('class' => 'form-control','required'=>'required'))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    <?php echo e(Form::file('carlabel')); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    <?php echo e(Form::file('recvlabel')); ?>

                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="ti ti-trash text-white text-danger" data-repeater-delete></a>
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

    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("journal-entry.index")); ?>';" class="btn btn-light">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
    </div>
    <?php echo e(Form::close()); ?>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u702545921/domains/shopinbyld.com/public_html/resources/views/productservice/editlabel.blade.php ENDPATH**/ ?>