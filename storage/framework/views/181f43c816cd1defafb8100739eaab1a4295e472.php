<?php echo e(Form::open(array('url' => 'payment','enctype' => 'multipart/form-data'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('date', __('Date'),['class'=>'form-label'])); ?>

            <div class="form-icon-user">
                <?php echo e(Form::date('date',null,array('class'=>'form-control','required'=>'required'))); ?>


            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('amount', __('Amount'),['class'=>'form-label'])); ?>

            <div class="form-icon-user">
                <?php echo e(Form::number('amount', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('account_id', __('Account'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('account_id',$accounts,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('vender_id', __('Vendor'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('vender_id', $venders,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description', '', array('class' => 'form-control','rows'=>3))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('category_id', __('Category'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('category_id', $categories,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('reference', __('Reference'),['class'=>'form-label'])); ?>

            <div class="form-icon-user">
                <?php echo e(Form::text('reference', '', array('class' => 'form-control'))); ?>

            </div>
        </div>

        <div class="col-md-12">
            <?php echo e(Form::label('add_receipt',__('Payment Receipt'),['class'=>'form-label'])); ?>

            <div class="choose-file form-group">
                <label for="image" class="form-label">
                    <input type="file" class="form-control" name="add_receipt" id="image" data-filename="upload_file" required>
                </label>
                <p class="upload_file"></p>
            </div>
        </div>



    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH /home3/amarcmar/public_html/crm/resources/views/payment/create.blade.php ENDPATH**/ ?>