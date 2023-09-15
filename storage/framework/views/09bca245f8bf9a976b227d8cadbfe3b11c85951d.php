<?php echo e(Form::open(array('url' => 'threepl'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('size', __('Size'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('size', '', array('class' => 'form-control','required'=>'required'))); ?>

            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="invalid-name" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('landedcost', __('Landed Cost'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('landedcost', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('tax', __('Tax%'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('tax', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

            <?php $__errorArgs = ['rate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <small class="invalid-rate" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </small>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('shipping', __('Shipping'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('shipping', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('markup', __('Markup'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('markup', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('boxcost', __('ById,s Box Cost'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('boxcost', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('labourcost', __('ById,s Labour Cost'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('labourcost', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\productsystm\resources\views/threepl/create.blade.php ENDPATH**/ ?>