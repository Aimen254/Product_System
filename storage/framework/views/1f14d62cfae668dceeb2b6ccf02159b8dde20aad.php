<?php echo e(Form::model($commission,array('route' => array('commission.update', $commission->id), 'method' => 'PUT'))); ?>

<div class="modal-body">

    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('title', __('Title'))); ?>

                    <?php echo e(Form::text('title',null, array('class' => 'form-control ','required'=>'required'))); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('type', __('Type'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::select('type', $commissions, null, ['class' => 'form-control select amount_type', 'required' => 'required'])); ?>

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('amount', __('Amount'),['class' => 'form-label amount_label'])); ?>

                    <?php echo e(Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01'))); ?>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home3/amarcmar/public_html/crm/resources/views/commission/edit.blade.php ENDPATH**/ ?>