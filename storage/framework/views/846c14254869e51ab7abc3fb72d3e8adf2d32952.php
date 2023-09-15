<?php echo e(Form::model($productService, array('route' => array('deliver.update', $productService->id), 'method' => 'PUT','enctype' => 'multipart/form-data'))); ?>

<div class="modal-body">
    <div class="row">
    <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('recived', __('Select Recieved Status'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <select name="recived" id="status" class="form-control main-element select4">
                    <option value="">Select Recieved Status</option>
                    <?php $__currentLoopData = \App\Models\ProductService::$recieved_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('delivery', __('Select Delivery Status'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <select name="delivery" class="form-control main-element select3">
                <?php $__currentLoopData = \App\Models\ProductService::$delivery_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-md-6 showid"  style="display: none;">
         <div class="form-group">
            <?php echo e(Form::label('acount_id', __('Select Account'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('acount_id[]', $acount,null, array('class' => 'form-control select2','id'=>'choices-multiple1','multiple'))); ?>


        </div>
    </div>
    <div class="col-md-6 showid"  style="display: none;">
        <div class="form-group">
            <?php echo e(Form::label('warehouse_id', __('Warehouse'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('warehouse_id', $warehouse,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-md-6 showid"  style="display: none;">
        <div class="form-group">
            <?php echo e(Form::label('labell', __('Label'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('label', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-md-6 showid"  style="display: none;">
        <div class="form-group">
            <?php echo e(Form::label('pdf', __('Upload Document'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <input type="file" class="form-control" name="pdf" id="attachment" data-filename="attachment_create">
        </div>
    </div>
     
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<script>
$('#status').on('change',function(){
    var some = $(this).find('option:selected').val(); 
    if(some == 'recieved'){
       $('.showid').show();
    }else{
        $('.showid').hide();
    }
});
</script><?php /**PATH C:\xampp\htdocs\productsystm\resources\views/productservice/editdelivery.blade.php ENDPATH**/ ?>