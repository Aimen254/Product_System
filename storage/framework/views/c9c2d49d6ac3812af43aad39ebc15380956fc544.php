<?php echo e(Form::model($productService, array('route' => array('prod.users.update', $productService->id), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('users', __('User'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('users[]', $users,false, array('class' => 'form-control select2','id'=>'choices-multiple3','multiple'=>''))); ?>

        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\product\resources\views/productservice/users.blade.php ENDPATH**/ ?>