<?php echo e(Form::model($productService, array('route' => array('puchase.update', $productService->id), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('purchase', __('Select Purchase Status'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <select name="purchase" id="status" class="form-control main-element select2">
                <option value="">Select Purchase Status</option>
                    <?php $__currentLoopData = \App\Models\ProductService::$purchase_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 showid" style="display: none;">
            <div class="form-group ">
                <?php echo e(Form::label('order_id', __('Order Id'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('order_id', '', array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-md-6 showid"  style="display: none;">
            <div class="form-group">
                <?php echo e(Form::label('track_id', __('Track Id'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('track_id', '', array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="col-md-6 showid"  style="display: none;">
            <?php echo e(Form::label('acount_id', __('Account'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('acount_id', $acount,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="col-md-6 showid"  style="display: none;">
            <?php echo e(Form::label('warehouse_id', __('Warehouse'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('warehouse_id', $warehouse,null, array('class' => 'form-control select','required'=>'required'))); ?>

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
    if(some == 'purchased'){
       $('.showid').show();
    }else{
        $('.showid').hide();
    }
});
</script><?php /**PATH C:\xampp\htdocs\productsystm\resources\views/productservice/editpurchase.blade.php ENDPATH**/ ?>